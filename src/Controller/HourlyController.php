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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/hourly')]
class HourlyController extends AbstractController
{
    #[Route('/', name: 'app_hourly_index', methods: ['GET'])]
    public function index(HourlyRepository $hourlyRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $hourlies = $hourlyRepository->findBy([], ['id' => 'ASC']);
        $hourlies = $paginator->paginate(
            $hourlies,
            $request->query->getInt('page', 1), 6);
        return $this->render('pages/hourly/index.html.twig', [
            'hourlies' => $hourlies
        ]);
    }


    #[Route('/user', name: 'app_hourly_user-index', methods: ['GET'])]
    public function indexUser(HourlyRepository $hourlyRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $hourlies = $hourlyRepository->findBy([], ['date' => 'ASC']);
        $hourlies = $paginator->paginate(
            $hourlies,
            $request->query->getInt('page', 1), 6);
        return $this->render('pages/hourly/indexUser.html.twig', [
            'hourlies' => $hourlies
        ]);
    }

    #[Route('/new', name: 'app_hourly_new', methods: ['GET', 'POST'])]
    public function new(Request $request, HourlyRepository $hourlyRepository): Response
    {
        $hourly = new Hourly();
        $form = $this->createForm(HourlyType::class, $hourly);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hourlyRepository->add($hourly, true);

            return $this->redirectToRoute('app_hourly_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('/pages/hourly/new.html.twig', [
            'hourly' => $hourly,
            'form' => $form,
        ]);
    }

    #[Route('/newHourlyHospital', name: 'app_hourly_new_hospital', methods: ['GET', 'POST'])]
    public function newHourlyHospital(Request $request, HourlyRepository $hourlyRepository): Response
    {
        $hourly = new Hourly();
        $form = $this->createForm(HourlyType::class, $hourly);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hourlyRepository->add($hourly, true);

            return $this->redirectToRoute('partnersHospitalHome', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('/pages/hourly/newHospital.html.twig', [
            'hourly' => $hourly,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hourly_show', methods: ['GET'])]
    public function show(Hourly $hourly): Response
    {
        return $this->render('pages/hourly/show.html.twig', [
            'hourly' => $hourly,
        ]);
    }

    #[Route('/{id}/message', name: 'app_hourly_show_message', methods: ['GET'])]
    public function showMessage(Hourly $hourly): Response
    {
        return $this->render('pages/hourly/showMessage.html.twig', [
            'hourly' => $hourly,
        ]);
    }

    #[Route('/{id}/admin', name: 'app_hourly_showAdmin', methods: ['GET'])]
    public function showAdmin(Hourly $hourly): Response
    {
        return $this->render('pages/hourly/showAdmin.html.twig', [
            'hourly' => $hourly,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_hourly_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Hourly $hourly, HourlyRepository $hourlyRepository): Response
    {
        $form = $this->createForm(HourlyType::class, $hourly);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hourlyRepository->add($hourly, true);

            return $this->redirectToRoute('app_hourly_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/hourly/edit.html.twig', [
            'hourly' => $hourly,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hourly_delete', methods: ['POST'])]
    public function delete(Request $request, Hourly $hourly, HourlyRepository $hourlyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $hourly->getId(), $request->request->get('_token'))) {
            $hourlyRepository->remove($hourly, true);
        }

        return $this->redirectToRoute('app_hourly_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route (path: '/favoris/add/{id}', name: 'add_favoris')]

    public function addFavoris(Hourly $hourly, EntityManagerInterface $em)
    {
        if(!$hourly){
            throw new NotFoundHttpException('Pas d\'annonce trouvée');
        }
        $hourly->addFavori($this->getUser());
        $em->persist($hourly);
        $em->flush();
        return $this->redirectToRoute('userAdminMessage');
    }

    #[Route (path: '/favoris/remove/{id}' , name: 'remove_favoris') ]

    public function removeFavoris(Hourly $hourly, EntityManagerInterface $em)
    {
        if(!$hourly){
            throw new NotFoundHttpException('Pas d\'annonce trouvée');
        }
        $hourly->removeFavori($this->getUser());

        $em->persist($hourly);
        $em->flush();
        return $this->redirectToRoute('app_hourly_user-index');
    }

}



