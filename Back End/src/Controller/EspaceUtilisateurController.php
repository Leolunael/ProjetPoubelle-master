<?php

namespace App\Controller;

use App\Entity\Signalement;
use App\Form\SignalementType;
use App\Repository\SignalementRepository;
use App\Repository\PointFideliteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class EspaceUtilisateurController extends AbstractController
{
    #[Route('/espace/utilisateur', name: 'app_espace_utilisateur')]
    public function index(): Response
    {
        return $this->render('espace_utilisateur/index.html.twig', [
            'controller_name' => 'EspaceUtilisateurController',
        ]);
    }

    #[Route('/espace/mes-points', name: 'user_points')]
    public function dashboard(): Response
    {
        return $this->render('espace_utilisateur/dashboard.html.twig');
    }

    #[Route('/espace/mes-points/detail', name: 'user_points_detail')]
    public function mesPoints(Security $security, PointFideliteRepository $repo): Response
    {
        $user = $security->getUser();

        $points = $repo->createQueryBuilder('p')
            ->select('SUM(p.points) as total')
            ->where('p.utilisateur = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getSingleScalarResult();

        $details = $repo->findBy(['utilisateur' => $user]);

        return $this->render('espace_utilisateur/mes_points.html.twig', [
            'total' => $points,
            'details' => $details,
        ]);
    }

    #[Route('/espace/mes-signalements', name: 'user_signalements')]
    public function mesSignalements(SignalementRepository $repo): Response
    {
        $signalements = $repo->findBy(['utilisateur' => $this->getUser()]);

        return $this->render('espace_utilisateur/mes_signalements.html.twig', [
            'signalements' => $signalements,
        ]);
    }

    #[Route('/espace/mes-signalements/{id}/edit', name: 'user_signalement_edit')]
    public function editSignalement(Signalement $signalement, Request $request, EntityManagerInterface $em): Response
    {
        if ($signalement->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException("Vous ne pouvez pas modifier ce signalement.");
        }

        $form = $this->createForm(SignalementType::class, $signalement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Signalement modifié avec succès.');
            return $this->redirectToRoute('user_signalements');
        }

        return $this->render('espace_utilisateur/edit_signalement.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/espace/mes-signalements/{id}/delete', name: 'user_signalement_delete', methods: ['POST'])]
    public function deleteSignalement(Signalement $signalement, Request $request, EntityManagerInterface $em): Response
    {
        if ($signalement->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException("Vous ne pouvez pas supprimer ce signalement.");
        }

        if ($this->isCsrfTokenValid('delete_signalement_'.$signalement->getId(), $request->request->get('_token'))) {
            $em->remove($signalement);
            $em->flush();
            $this->addFlash('success', 'Signalement supprimé avec succès.');
        }

        return $this->redirectToRoute('user_signalements');
    }
}
