<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizPageController extends AbstractController
{
    #[Route('/quiz/dechets', name: 'quiz_dechets')]
    public function index(): Response
    {
        // Ici vous pouvez récupérer l'utilisateur connecté
        $user = $this->getUser();
        $userId = $user ? $user->getId() : 1; // Valeur par défaut pour les tests

        return $this->render('quiz/dechets.html.twig', [
            'userId' => $userId,
        ]);
    }
}