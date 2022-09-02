<?php

namespace App\Controller;

use App\Entity\AdminMessage;
use App\Entity\HourlyRequest;
use App\Form\AdminMessageType;
use App\Form\HourlyRequestType;
use App\Repository\AdminMessageRepository;
use App\Repository\HourlyRequestRepository;
use Doctrine\ORM\EntityManagerInterface;
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
}