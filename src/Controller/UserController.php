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


    #[Route (path: 'hourly_search', name: 'hourly-search')]

    public function hourly_search( Request $request, HourlyRepository $hourlyRepository, PaginatorInterface $paginator):Response
    {
        $hourlySearch = new HourlySearch();
        $result= [];
        $form = $this->createForm(HourlySearchType::class, $hourlySearch);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $result = $hourlyRepository->findBySearch($hourlySearch);
            $result = $paginator->paginate(
                $result,
                $request->query->getInt('page', 1), 6);
        }
        return $this->render('pages/hourly/indexUser.html.twig', ['hourlies' => $result]);
    }

}