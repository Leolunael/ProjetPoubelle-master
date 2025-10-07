<?php

namespace App\Controller;

use App\Entity\PointFidelite;
use App\Form\PointFideliteType; // ✅ <-- cette ligne est essentielle
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PointFideliteController extends AbstractController
{
    #[Route('/point/fidelite', name: 'app_point_fidelite')]
    public function index(): Response
    {
        return $this->render('point_fidelite/index.html.twig', [
            'controller_name' => 'PointFideliteController',
        ]);
    }

    #[Route('/admin/points/new', name: 'admin_points_new')]
public function new(Request $request, EntityManagerInterface $em): Response
{
    $this->denyAccessUnlessGranted('ROLE_ADMIN');

    $point = new PointFidelite();
    $form = $this->createForm(PointFideliteType::class, $point);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($point);
        $em->flush();

        $this->addFlash('success', 'Points attribués avec succès.');
        return $this->redirectToRoute('admin_points_new');
    }

    return $this->render('points/new.html.twig', [
        'form' => $form->createView(),
    ]);
}
}
