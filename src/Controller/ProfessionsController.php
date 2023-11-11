<?php

namespace App\Controller;

use App\Entity\Professions;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/professions')]

class ProfessionsController extends AbstractController
{
    #[Route('/', name: 'app_professions')]
    public function index(): Response
    {
        return $this->render('professions/index.html.twig', [
            'controller_name' => 'ProfessionsController',
        ]);
    }

    #[Route("/ajout/ajax/{label}", name: 'app_prenoms_ajout_ajax', methods: ['POST'])]
    public function ajoutAjax(string $label, Request $request, EntityManagerInterface $entityManager): Response
    {
        $profession = new Professions();
        $profession->setDesignation(ucwords(trim(strip_tags($label))));
        $entityManager->persist($profession);
        $entityManager->flush();
        //on récupère l'Id qui a été créé
        $id = $profession->getId();

        return new JsonResponse(['id' => $id]);
    }
}
