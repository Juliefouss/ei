<?php

namespace App\Controller;

use App\Entity\AdminMessage;
use App\Entity\DeleteMessage;
use App\Entity\HourlyRequest;
use App\Form\AdminMessageType;
use App\Form\DeleteMessageType;
use App\Form\HourlyRequestType;
use App\Repository\AdminMessageRepository;
use App\Repository\DeleteMessageRepository;
use App\Repository\HourlyRepository;
use App\Repository\HourlyRequestRepository;
use App\Search\Hospital\HourlyHospitalSearch;
use App\Search\Hospital\HourlyHospitalSearchType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartnerHospitalsController extends AbstractController
{

    #[Route (path:'/partnersHospital/home' , name: 'partnersHospitalHome')]
    public function home():Response{
        return $this->render('pages/include/partnerHospitals_home.html.twig');
    }

    #[Route (path:'/partnersHospital/form', name: 'partnersHospitalForm')]
    public function HourlyRequest(Request $request, HourlyRequestRepository $hourlyRequestRepository, EntityManagerInterface $em):Response{
        $hourlyRequest = new HourlyRequest();
        $form = $this->createForm(HourlyRequestType::class, $hourlyRequest);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($hourlyRequest);
            $em->flush();
            return $this->redirectToRoute('partnersHospitalHome');
        }
        return $this->renderForm('pages/PartnerHospitals/hourlyRequestForm.html.twig', [
            'hourlyRequest'=> $hourlyRequest,
            'form' => $form
        ]);
    }


    #[Route(path: '/partnersHospital/adminMessage', name: 'partnerHospital-adminMessage')]

    public function amdinMessage(AdminMessageRepository $adminMessageRepository, EntityManagerInterface $em, Request $request): Response{
        $adminMessage = new AdminMessage();
        $form = $this->createForm(AdminMessageType::class, $adminMessage);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($adminMessage);
            $em->flush();
            return $this->redirectToRoute('partnersHospitalHome');
        }
        return $this->renderForm('pages/PartnerHospitals/partnerHospitals_messages.html.twig', [
            'adminMessage' =>$adminMessage,
            'adminMessageform' => $form
        ]);
    }

    #[Route(path: '/partnersHospital/deleteMessage', name: 'partnerHospital-deleteMessage')]

    public function deleteMessage(DeleteMessageRepository $deleteMessageRepository, EntityManagerInterface $em, Request $request): Response{
        $deleteMessage = new DeleteMessage();
        $form = $this->createForm(DeleteMessageType::class, $deleteMessage);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($deleteMessage);
            $em->flush();
            return $this->redirectToRoute('app_hourly_hospital_index');
        }
        return $this->renderForm('pages/PartnerHospitals/deleteMessage.html.twig', [
            'deleteMessage' =>$deleteMessage,
            'deleteMessageForm' => $form
        ]);
    }


    #[Route(path: 'hourlyHospitalSearch' , name: 'hourlyHospitalSearch')]
    public function hourlyHospitalSearch( Request $request, HourlyRepository $hourlyRepository, PaginatorInterface $paginator):Response
    {
        $hourlyHospitalSearch = new HourlyHospitalSearch();
        $result= [];
        $form = $this->createForm(HourlyHospitalSearchType::class, $hourlyHospitalSearch);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $result = $hourlyRepository->findByHospitalSearch($hourlyHospitalSearch);
            $result = $paginator->paginate(
                $result,
                $request->query->getInt('page', 1), 6);
        }
        return $this->render('pages/hourly/indexHospital.html.twig', ['hourlies' => $result]);
    }
}