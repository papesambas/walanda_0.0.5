<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MeresController extends AbstractController
{
    #[Route('/meres', name: 'app_meres')]
    public function index(): Response
    {
        return $this->render('meres/index.html.twig', [
            'controller_name' => 'MeresController',
        ]);
    }
}
