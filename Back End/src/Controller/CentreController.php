<?php

namespace App\Controller;

use App\Entity\CentreRecyclage;
use App\Form\CentreRecyclageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request; // ✅ à ajouter
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CentreController extends AbstractController
{
   #[Route('/centres', name: 'centre_liste')]
public function liste(EntityManagerInterface $em): Response
{
    $centres = $em->getRepository(CentreRecyclage::class)->findAll();

    return $this->render('centre/liste.html.twig', [
        'centres' => $centres,
    ]);
}

#[Route('/centre/{id<\d+>}', name: 'centre_detail')]
public function detail(CentreRecyclage $centre): Response
{
    return $this->render('centre/detail.html.twig', [
        'centre' => $centre,
    ]);
}

#[Route('/centre/new', name: 'centre_new')]
public function new(Request $request, EntityManagerInterface $em): Response
{
    $centre = new CentreRecyclage();
    $form = $this->createForm(CentreRecyclageType::class, $centre);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($centre);
        $em->flush();

        return $this->redirectToRoute('centre_liste');
    }

    return $this->render('centre/new.html.twig', [
        'form' => $form->createView(),
    ]);
}

}
