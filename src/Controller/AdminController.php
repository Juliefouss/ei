<?php

namespace App\Controller;

use App\Entity\Hourly;
use App\Form\HourlyType;
use App\Repository\HourlyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
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

    #[Route(path: '/admin_hourly', name: 'admin-hourly')]
    public function admin_hourly(HourlyRepository $hourlyRepository, PaginatorInterface $paginator, Request $request):Response{
        $hourlies = $hourlyRepository->findAll();
        $hourlies = $paginator->paginate(
            $hourlies,
            $request->query->getInt('page', 1),6);
        return $this->render('pages/admin/admin-hourly.html.twig', ['hourlies'=>$hourlies]);
    }

    #[Route(path: '/admin_newHourly', name: 'admin-newHourly')]
    public function admin_newApply(Request $request, EntityManagerInterface $em): Response{
        $hourly = new Hourly();
        $form = $this->createForm(HourlyType::class, $hourly);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $em->persist((object)$hourly);
            $em->flush();
            return $this->redirectToRoute ('admin-hourly');
        }

        return $this->render('pages/admin/admin-newHourly.html.twig', ['HourlyForm'=>$form->createView()]);
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