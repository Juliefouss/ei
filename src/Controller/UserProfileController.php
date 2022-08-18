<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegisterType;
use App\Repository\UserRepository;
use App\Service\PhotoUploader;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/profile')]
class UserProfileController extends AbstractController
{
    #[Route('/', name: 'app_user_profile_index', methods: ['GET'])]
    public function user_profile(): Response
    {
        return $this->render('pages/users/user_profile/index.html.twig');
    }


    /**
     * @throws NonUniqueResultException
     */
    #[Route('/{id}/edit', name: 'app_user_profile_edit', methods: ['GET', 'POST'])]
    public function edit( int $id, Request $request, User $user, UserRepository $userRepository, EntityManagerInterface $em, PhotoUploader $photoUploader): Response

    {
        $user =$userRepository->findById($id);
        $form = $this->createForm(UserRegisterType::class, $user);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('app_user_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/users/user_profile/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_profile_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_profile_index', [], Response::HTTP_SEE_OTHER);
    }
}
