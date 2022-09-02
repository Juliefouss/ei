<?php

namespace App\Controller;

use App\Entity\HourlyRequest;
use App\Repository\HourlyRequestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/hourlyRequest')]
class HourlyRequestController extends AbstractController
{
    #[Route('/', name: 'app_hourly_request_index', methods: ['GET'])]
    public function index(HourlyRequestRepository $hourlyRequestRepository): Response
    {
        return $this->render('pages/hourly_request/index.html.twig', [
            'hourly_requests' => $hourlyRequestRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_hourly_request_show', methods: ['GET'])]
    public function show(HourlyRequest $hourlyRequest): Response
    {
        return $this->render('pages/hourly_request/show.html.twig', [
            'hourly_request' => $hourlyRequest,
        ]);
    }

    #[Route('/{id}', name: 'app_hourly_request_delete', methods: ['POST'])]
    public function delete(Request $request, HourlyRequest $hourlyRequest, HourlyRequestRepository $hourlyRequestRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hourlyRequest->getId(), $request->request->get('_token'))) {
            $hourlyRequestRepository->remove($hourlyRequest, true);
        }

        return $this->redirectToRoute('app_hourly_request_index', [], Response::HTTP_SEE_OTHER);
    }
}
