<?php

namespace App\Controller;

use App\Entity\AdminMessage;
use App\Entity\Hourly;
use App\Repository\AdminMessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

    #[Route (path: '/textChange/add/{id}', name: 'add_textChange')]

    public function addtextChange(AdminMessage $adminMessage, EntityManagerInterface $em)
    {
        if(!$adminMessage){
            throw new NotFoundHttpException('Pas de message trouvé');
        }
        $adminMessage->addTextChange($this->getUser());
        $em->persist($adminMessage);
        $em->flush();
        return $this->redirectToRoute('app_hourly_index');
    }

    #[Route (path: '/textChange/remove/{id}' , name: 'remove_textChange') ]

    public function removeTextChange(AdminMessage $adminMessage, EntityManagerInterface $em)
    {
        if(!$adminMessage){
            throw new NotFoundHttpException('Pas de message');
        }
        $adminMessage->removeTextChange($this->getUser());

        $em->persist($adminMessage);
        $em->flush();
        return $this->redirectToRoute('app_hourly_index');
    }
}
