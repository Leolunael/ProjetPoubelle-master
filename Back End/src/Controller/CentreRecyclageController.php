<?php

namespace App\Controller;

use App\Form\CentreRecyclageType;
use App\Entity\CentreRecyclage;
//use App\Form\CentreRecyclageForm;
use App\Repository\CentreRecyclageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/centre/recyclage')]
#[IsGranted('ROLE_ADMIN')] // ✅ accès restreint à tous les admins
final class CentreRecyclageController extends AbstractController
{
    #[Route('/admin/centre_recyclage', name: 'app_centre_recyclage_index', methods: ['GET'])]
    public function index(CentreRecyclageRepository $centreRecyclageRepository): Response
    {
        return $this->render('centre_recyclage/index.html.twig', [
            'centre_recyclages' => $centreRecyclageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_centre_recyclage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $centreRecyclage = new CentreRecyclage();
        $form = $this->createForm(CentreRecyclageType::class, $centreRecyclage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($centreRecyclage);
            $entityManager->flush();

            return $this->redirectToRoute('app_centre_recyclage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('centre_recyclage/new.html.twig', [
            'centre_recyclage' => $centreRecyclage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_centre_recyclage_show', methods: ['GET'])]
    public function show(CentreRecyclage $centreRecyclage): Response
    {
        return $this->render('centre_recyclage/show.html.twig', [
            'centre_recyclage' => $centreRecyclage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_centre_recyclage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CentreRecyclage $centreRecyclage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CentreRecyclageType::class, $centreRecyclage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_centre_recyclage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('centre_recyclage/edit.html.twig', [
            'centre_recyclage' => $centreRecyclage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_centre_recyclage_delete', methods: ['POST'])]
    public function delete(Request $request, CentreRecyclage $centreRecyclage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$centreRecyclage->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($centreRecyclage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_centre_recyclage_index', [], Response::HTTP_SEE_OTHER);
    }
}
