<?php

namespace App\Controller;

use App\Entity\DeleteMessage;
use App\Entity\Hourly;
use App\Repository\DeleteMessageRepository;
use App\Repository\HourlyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/delete/message')]
class DeleteMessageController extends AbstractController
{
    #[Route('/', name: 'app_delete_message_index', methods: ['GET'])]
    public function index(DeleteMessageRepository $deleteMessageRepository, HourlyRepository $hourlyRepository): Response
    {
        return $this->render('pages/admin/delete_message/index.html.twig', [
            'delete_messages' => $deleteMessageRepository->findAll(),

        ]);
    }

    #[Route('/{id}', name: 'app_delete_message_delete', methods: ['POST'])]
    public function delete(Request $request, DeleteMessage $deleteMessage, DeleteMessageRepository $deleteMessageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$deleteMessage->getId(), $request->request->get('_token'))) {
            $deleteMessageRepository->remove($deleteMessage, true);
        }

        return $this->redirectToRoute('app_delete_message_index', [], Response::HTTP_SEE_OTHER);
    }
}
