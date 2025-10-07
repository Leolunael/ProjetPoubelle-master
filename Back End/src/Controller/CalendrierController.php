<?php


namespace App\Controller;

use App\Repository\CalendrierCollecteRepository;
use App\Entity\CalendrierCollecte;
use App\Form\CalendrierSearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CalendrierController extends AbstractController
{
#[Route('/calendrier', name: 'calendrier_index')]
public function index(Request $request, EntityManagerInterface $em, CalendrierCollecteRepository $repo): Response
{
     $form = $this->createForm(CalendrierSearchType::class);
     $form->handleRequest($request);
    // Initialisation
      $adresse = $form->get('adresse')->getData();
    $resultats = [];

    // Traitement de la requête POST
    if ($request->isMethod('POST')) {
        
        
        if (!empty($adresse)) {
            // Création de la requête
            $resultats = $repo->findByAdressePartialMatch($adresse);
            
            
            // Debug après exécution
            dump('résultats', $resultats);
        }
    }else{
        $resultats = $repo->findAll();
    }

    return $this->render('calendrier/index.html.twig', [
        'form' => $form->createView(),
        'resultats' => $resultats,
        'adresse_recherchee' => $adresse,
        'searchPerformed' => $request->isMethod('POST')
    ]);
}
}