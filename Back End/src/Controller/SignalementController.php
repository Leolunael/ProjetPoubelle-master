<?php
namespace App\Controller;

use App\Entity\Signalement;
use App\Form\SignalementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SignalementController extends AbstractController
{
    #[Route('/signalement/new', name: 'signalement_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $signalement = new Signalement();
        $signalement->setUtilisateur($this->getUser()); // 🔗 Associe l'utilisateur
        $signalement->setDate(new \DateTimeImmutable()); // date auto

        $form = $this->createForm(SignalementType::class, $signalement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($signalement);
            $em->flush();
            

            
           

            $this->addFlash('success', 'Signalement enregistré avec succès.');
            // ✅ Redirige vers la même page
            return $this->redirectToRoute('signalement_new');
            //return $this->redirectToRoute('app_espace_utilisateur');
        }

        return $this->render('signalement/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

