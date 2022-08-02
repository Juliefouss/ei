<?php
namespace App\Controller;
use App\Entity\Contact;
use App\Entity\ContactMessage;
use App\Form\ContactMessageType;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends AbstractController
{
//    Route créer pour le chemin vers la page home
     #[Route(path: '/', name: 'home')]

    public function home(): Response
    {
        return $this->render('pages/home.html.twig');
    }
//    Route pour créer le chemin vers la page about
    #[Route(path: '/about' , name: 'about')]

    public function about(): Response{
        return $this->render('pages/about.html.twig');
    }

    //    Route pour créer le chemin vers la page de contact et pour permettre à un utilisateur de contacter l'admin via le formulaire de contact
     #[Route(path: '/contact' ,name: 'contact' )]
    public function contactMessage(Request $request, EntityManagerInterface $em): Response
    {
        $contact= new ContactMessage();
        $form=$this->createForm(ContactMessageType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()){
            $em->persist($contact);
            $em->flush();
            return $this->render ('pages/thanks.html.twig');

        }
        return $this->render('pages/contact.html.twig', ['contactMessageForm'=>$form->createView()]);
    }
}