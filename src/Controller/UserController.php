<?php

namespace App\Controller;

use App\Repository\HourlyRepository;
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

    #[Route(path : '/user_search', name: 'user-search')]

    public function userSearch(): Response{
        return $this->render('pages/users/user-search.html.twig');
    }




}