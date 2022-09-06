<?php

namespace App\Controller;

use App\Entity\ContactMessage;
use App\Form\ContactMessageType;
use App\Repository\ContactMessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contact/message')]
class ContactMessageController extends AbstractController
{
    #[Route('/', name: 'app_contact_message_index', methods: ['GET'])]
    public function index(ContactMessageRepository $contactMessageRepository): Response
    {
        return $this->render('pages/admin/contact_message/index.html.twig', [
            'contact_messages' => $contactMessageRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_contact_message_show', methods: ['GET'])]
    public function show(ContactMessage $contactMessage): Response
    {
        return $this->render('pages/admin/contact_message/show.html.twig', [
            'contact_message' => $contactMessage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_contact_message_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ContactMessage $contactMessage, ContactMessageRepository $contactMessageRepository): Response
    {
        $form = $this->createForm(ContactMessageType::class, $contactMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactMessageRepository->add($contactMessage, true);

            return $this->redirectToRoute('app_contact_message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contact_message/edit.html.twig', [
            'contact_message' => $contactMessage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_contact_message_delete', methods: ['POST'])]
    public function delete(Request $request, ContactMessage $contactMessage, ContactMessageRepository $contactMessageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contactMessage->getId(), $request->request->get('_token'))) {
            $contactMessageRepository->remove($contactMessage, true);
        }

        return $this->redirectToRoute('app_contact_message_index', [], Response::HTTP_SEE_OTHER);
    }
}