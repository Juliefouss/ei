<?php

namespace App\Controller;

use App\Repository\HourlyRepository;
use App\Search\User\HourlySearch;
use App\Search\User\HourlySearchType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route(path: '/user_home', name: 'user-home')]

    public function user_home(): Response {
        return $this->render('pages/include/user-home.html.twig');
    }

    #[Route(path: '/user_apply', name: 'user-apply')]

    public function user_apply(HourlyRepository $hourlyRepository, PaginatorInterface $paginator, Request $request): Response{
        $hourlies = $hourlyRepository->findAll();
        $hourlies = $paginator->paginate(
            $hourlies,
            $request->query->getInt('pages', 1),6);
        return $this->render('pages/users/user-apply.html.twig', ['hourlies'=>$hourlies]);
    }



    #[Route (path: '/hourly_search', name: 'hourly-search')]

    public function hourly_search( Request $request, HourlyRepository $hourlyRepository, PaginatorInterface $paginator):Response
    {
        $hourlySearch = new HourlySearch();
        $form = $this->createForm(HourlySearchType::class, $hourlySearch);
        $form->handleRequest($request);
        $result = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $result = $hourlyRepository->findBySearch($hourlySearch);
        }
        return $this->render('pages/hourly/show.html.twig', ['hourlies' => $result]);
    }


}