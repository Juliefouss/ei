<?php

namespace App\Controller;

use App\Entity\Hospital;
use App\Entity\Service;
use App\Form\HospitalType;
use App\Form\ServiceType;
use App\Repository\UserRepository;
use App\Search\Admin\SearchUser;
use App\Search\Admin\SearchUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route(path: '/admin_home', name: 'admin-home')]
    public function admin_home(): Response {
        return $this->render('pages/include/admin-home.html.twig');
    }


    #[Route(path : '/admin_SearchUser', name: 'admin-searchUser')]

    public function adminSearchUser( Request $request, UserRepository $userRepository): Response{

        $searchUser = new SearchUser();
        $form = $this->createForm(SearchUserType::class, $searchUser);
        $form->handleRequest($request);
        $result =[];
        if ($form->isSubmitted() && $form->isValid()){
            $result = $userRepository->findBySearch($searchUser);
        }
        return $this->render('pages/admin/searchUser.html.twig', ['users'=>$result]);

    }

    #[Route (path: '/adminAddHospital', name: 'adminAddHospital')]
    public function adminAddHospital(Request $request,EntityManagerInterface $em):Response{
        $hospital = new Hospital();
        $form = $this->createForm(HospitalType::class, $hospital);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($hospital);
            $em->flush();
            return $this->redirectToRoute('admin-home');
        }
        return $this->render('pages/admin/addNewHospital.html.twig', ['hospitalForm' =>$form->createView()]);

    }

    #[Route(path: '/adminAddService', name: 'adminAddService')]
    public function adminAddService(Request $request, EntityManagerInterface $em):Response{
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($service);
            $em->flush();
            return $this->redirectToRoute('app_hourly_new');
        }
        return $this->render('pages/admin/addNewService.html.twig', ['serviceForm' =>$form->createView()]);

    }
}