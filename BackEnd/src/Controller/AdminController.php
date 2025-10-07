<?php

namespace App\Controller;

use App\Repository\SignalementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin_dashboard')]
public function index(): Response
{
    return $this->render('admin/index.html.twig');
}

#[Route('/admin/signalements', name: 'admin_signalements')]
public function signalements(SignalementRepository $repo): Response
{
    return $this->render('admin/signalements.html.twig', [
        'signalements' => $repo->findAll(),
    ]);
}

#[Route('/admin/signalement/{id}/delete', name: 'admin_signalement_delete', methods: ['POST'])]
public function deleteSignalement(Request $request, Signalement $signalement, EntityManagerInterface $em): Response
{
    if ($this->isCsrfTokenValid('delete' . $signalement->getId(), $request->request->get('_token'))) {
        $em->remove($signalement);
        $em->flush();
        $this->addFlash('success', 'Signalement supprimé avec succès.');
    }

    return $this->redirectToRoute('admin_signalements');
}

}
