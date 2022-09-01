<?php

namespace App\Controller;

use App\Entity\Hospital;
use App\Entity\Service;
use App\Form\HospitalType;
use App\Form\ServiceType;
use App\Repository\HourlyRepository;
use App\Repository\UserRepository;
use App\Search\Admin\HourlyAdminSearch;
use App\Search\Admin\HourlyAdminSearchType;
use App\Search\Admin\SearchUser;
use App\Search\Admin\SearchUserType;
use App\Search\User\HourlySearch;
use App\Search\User\HourlySearchType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route(path: '/admin_home', name: 'admin-home')]
    public function admin_home(): Response
    {
        return $this->render('pages/include/admin-home.html.twig');
    }


    #[Route(path: '/admin_SearchUser', name: 'admin-searchUser')]
    public function adminSearchUser(Request $request, UserRepository $userRepository): Response
    {

        $searchUser = new SearchUser();
        $form = $this->createForm(SearchUserType::class, $searchUser);
        $form->handleRequest($request);
        $result = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $result = $userRepository->findBySearch($searchUser);
        }
        return $this->render('pages/admin/searchUser.html.twig', ['users' => $result]);

    }

    #[Route(path: '/adminAddService', name: 'adminAddService')]
    public function adminAddService(Request $request, EntityManagerInterface $em): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($service);
            $em->flush();
            return $this->redirectToRoute('app_service_new');
        }
        return $this->render('pages/admin/addNewService.html.twig', ['serviceForm' => $form->createView()]);

    }


    #[Route (path: '/HourlySearchAdmin', name: 'hourlySearchAdmin')]
    public function hourlySearchAdmin(Request $request, HourlyRepository $hourlyRepository, PaginatorInterface $paginator): Response
    {
        $hourlyAdminSearch = new HourlyAdminSearch();
        $result= [];
        $form = $this->createForm(HourlyAdminSearchType::class, $hourlyAdminSearch);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $result = $hourlyRepository->findByAdminSearch($hourlyAdminSearch);
            $result = $paginator->paginate(
                $result,
                $request->query->getInt('page', 1), 6);
        }
        return $this->render('pages/hourly/index.html.twig', ['hourlies' => $result]);
    }
}