<?php

namespace App\Controller;

use App\Form\UserRegisterType;
use App\Repository\HourlyRepository;
use App\Repository\UserMessageRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route(path: '/user_home', name: 'user-home')]

    public function user_home(): Response {
        return $this->render('pages/users/user-home.html.twig');
    }

    #[Route(path: '/user_apply', name: 'user-apply')]

    public function user_apply(HourlyRepository $hourlyRepository, PaginatorInterface $paginator, Request $request): Response{
        $hourlies = $hourlyRepository->findAll();
        $hourlies = $paginator->paginate(
            $hourlies,
            $request->query->getInt('pages', 1),6);
        return $this->render('pages/users/user-apply.html.twig', ['hourlies'=>$hourlies]);
    }

    #[Route(path: 'user_message', name: 'user-message')]

    public function user_message( Request $request, UserMessageRepository $userMessageRepository, PaginatorInterface $paginator): Response{
        $userMessages = $userMessageRepository->findAll();
        $userMessages = $paginator->paginate(
            $userMessages,
            $request->query->getInt('pages', 1),5
        );
        return $this-> render('pages/users/user-message.html.twig', ['userMessages'=>$userMessages]);
    }

    #[Route(path: 'user_profile', name: 'user-profile')]

    public function user_profile(): Response{
        return $this->render('pages/users/user-profile.html.twig');
    }

    #[Route(path: 'user_edit_profil/{id}', name: 'user-edit-profil')]

    public function user_edit_profil(int $id, Request $request, UserRepository $userRepository, EntityManagerInterface $em ):Response{
        $user = $userRepository->find($id);
        $form = $this->createForm(UserRegisterType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){
            $em->persist($user);
            $em->flush();
            return $this->render('pages/users/user-profile.html.twig');
        }

        return $this->render('pages/users/user-edit-profil.html.twig', ['registerType' => $form->createView()]);
    }


}