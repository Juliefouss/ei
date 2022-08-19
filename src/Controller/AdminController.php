<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Search\Admin\SearchUser;
use App\Search\Admin\UserSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route(path: '/admin_home', name: 'admin-home')]
    public function admin_home(): Response {
        return $this->render('pages/admin/admin-home.html.twig');
    }

//
//    #[Route(path: '/admin_newHourly', name: 'admin-newHourly')]
//    public function admin_newApply(Request $request, EntityManagerInterface $em): Response{
//        $hourly = new Hourly();
//        $form = $this->createForm(HourlyType::class, $hourly);
//        $form->handleRequest($request);
//        if ($form->isSubmitted()&&$form->isValid()) {
//            $em->persist((object)$hourly);
//            $em->flush();
//            return $this->redirectToRoute ('admin-hourly');
//        }
//
//        return $this->render('pages/admin/admin-newHourly.html.twig', ['HourlyForm'=>$form->createView()]);
//    }


    #[Route(path: '/admin_users', name: 'admin-users')]
    public function admin_users(): Response
    {
        return $this->render('pages/admin/admin-users.html.twig');
    }


    #[Route(path : '/admin-SearchUser', name: 'admin-search')]

    public function adminSearch( Request $request, UserRepository $userRepository): Response{

        $searchUser = new SearchUser();
        $form = $this->createForm(UserSearchType::class, $searchUser);
        $form->handleRequest($request);
        $result =[];
        if ($form->isSubmitted() && $form->isValid()){
            $result = $userRepository->findBySearch($searchUser);

        }
        return $this->render('pages/admin/searchUser.html.twig', ['users'=>$result]);

    }





}