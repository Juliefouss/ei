<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends AbstractController
{
//    Route créer pour le chemin vers la page home
     #[Route(path: '/', name: 'home')]

    public function home(): Response
    {
        return $this->render('pages/home.html.twig');
    }
//    Route pour créer le chemin vers la page about
    #[Route(path: '/about' , name: 'about')]

    public function contact(): Response{
        return $this->render('pages/about.html.twig');
    }


}