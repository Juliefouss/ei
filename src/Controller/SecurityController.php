<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /** @Route("/register", name="register") */
    public function register():Response {
      return $this->render('pages/register.html.twig');
    }

    /** @Route("/login", name="login") */
    public function login() : Response {
      return  $this->render('pages/login.html.twig');
    }

}