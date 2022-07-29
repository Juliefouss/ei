<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route(path: '/admin_home', name: 'admin-home')]
    public function admin_home(): Response {
        return $this->render('pages/admin/admin-home.html.twig');
    }

    #[Route(path: '/admin_apply', name: 'admin-apply')]
    public function admin_apply():Response{
        return $this->render('pages/admin/admin-apply.html.twig');
    }

    #[Route(path: '/admin_newApply', name: 'admin-newApply')]
    public function admin_newApply(): Response{
        return $this->render('pages/admin/admin-newApply.html.twig');
    }

    #[Route(path: '/admin_users', name: 'admin-users')]
    public function admin_users(): Response
    {
        return $this->render('pages/admin/admin-users.html.twig');
    }

    #[Route(path: '/admin_message', name: 'admin-message')]
    public function admin_message(): Response{
        return $this->render('pages/admin/admin-message.html.twig');
    }
}