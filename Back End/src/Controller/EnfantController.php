<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EnfantController extends AbstractController
{
    #[Route('/enfant', name: 'enfant_index')]
    public function index(): Response
    {
        return $this->render('enfant/index.html.twig', [
            'controller_name' => 'EnfantController',
        ]);
    }
}
