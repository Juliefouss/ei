<?php

namespace App\Controller;

use App\Entity\AdminMessage;
use App\Repository\AdminMessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/message')]
class AdminMessageController extends AbstractController
{
    #[Route('/', name: 'app_admin_message_index', methods: ['GET'])]
    public function index(AdminMessageRepository $adminMessageRepository): Response
    {
        return $this->render('pages/admin/admin_message/index.html.twig', [
            'admin_messages' => $adminMessageRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_admin_message_show', methods: ['GET'])]
    public function show(AdminMessage $adminMessage): Response
    {
        return $this->render('pages/admin/admin_message/show.html.twig', [
            'admin_message' => $adminMessage,
        ]);
    }


    #[Route('/{id}', name: 'app_admin_message_delete', methods: ['POST'])]
    public function delete(Request $request, AdminMessage $adminMessage, AdminMessageRepository $adminMessageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adminMessage->getId(), $request->request->get('_token'))) {
            $adminMessageRepository->remove($adminMessage, true);
        }

        return $this->redirectToRoute('app_admin_message_index', [], Response::HTTP_SEE_OTHER);
    }
}
