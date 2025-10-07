<?php

namespace App\Controller;

use App\Entity\CalendrierCollecte;
use App\Form\CalendrierCollecteForm;
use App\Repository\CalendrierCollecteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted; // ✅ à ajouter

#[Route('/calendrier/collecte')]
#[IsGranted('ROLE_ADMIN')] // ✅ accès restreint à tous les admins
final class CalendrierCollecteController extends AbstractController
{
    #[Route(name: 'app_calendrier_collecte_index', methods: ['GET'])]
    public function index(CalendrierCollecteRepository $calendrierCollecteRepository): Response
    {
        return $this->render('calendrier_collecte/index.html.twig', [
            'calendrier_collectes' => $calendrierCollecteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_calendrier_collecte_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $calendrierCollecte = new CalendrierCollecte();
        $form = $this->createForm(CalendrierCollecteForm::class, $calendrierCollecte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($calendrierCollecte);
            $entityManager->flush();

            return $this->redirectToRoute('app_calendrier_collecte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('calendrier_collecte/new.html.twig', [
            'calendrier_collecte' => $calendrierCollecte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_calendrier_collecte_show', methods: ['GET'])]
    public function show(CalendrierCollecte $calendrierCollecte): Response
    {
        return $this->render('calendrier_collecte/show.html.twig', [
            'calendrier_collecte' => $calendrierCollecte,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_calendrier_collecte_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CalendrierCollecte $calendrierCollecte, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CalendrierCollecteForm::class, $calendrierCollecte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_calendrier_collecte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('calendrier_collecte/edit.html.twig', [
            'calendrier_collecte' => $calendrierCollecte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_calendrier_collecte_delete', methods: ['POST'])]
    public function delete(Request $request, CalendrierCollecte $calendrierCollecte, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$calendrierCollecte->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($calendrierCollecte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_calendrier_collecte_index', [], Response::HTTP_SEE_OTHER);
    }
}
