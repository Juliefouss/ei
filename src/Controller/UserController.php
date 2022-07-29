<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route(path: '/user_home', name: 'user-home')]
    public function user_home(): Response {
        return $this->render('pages/users/user-home.html.twig');
    }

    #[Route(path: '/user_apply', name: 'user-apply')]
    public function user_apply(): Response{
        return $this->render('pages/users/user-apply.html.twig');
    }

    #[Route(path: 'user_message', name: 'user-message')]
    public function user_message(): Response{
        return $this-> render('pages/users/user-message.html.twig');
    }

    #[Route(path: 'user_profile', name: 'user-profile')]
    public function user_profile(): Response{
        return $this->render('pages/users/user-profile.html.twig');
    }
}