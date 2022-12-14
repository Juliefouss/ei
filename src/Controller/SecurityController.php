<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegisterType;
use App\Service\PhotoUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/register', name: 'register')]
    public function register(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher, PhotoUploader $photoUploader): Response
    {
        $user = new User();
        $form = $this->createForm(UserRegisterType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            {
                $user->setPhoto($photoUploader->UploadPhoto($form->get('photo')));
                if ($user->getPhoto() !== null) {
                    $em->persist($user->getPhoto());
                }
                $user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));
                $user->setRoles(['ROLE_USER']);
            }
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('app_login');
        }
        return $this->render('security/register.html.twig', ['registerForm' => $form->createView()]);
    }


    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastEmail = $authenticationUtils->getLastEmail();

        return $this->render('security/login.html.twig', ['last_email' => $lastEmail, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }


}
