<?php

namespace App\Controller;

use App\Entity\Telephones;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/telephones')]

class TelephonesController extends AbstractController
{
    #[Route('/', name: 'app_telephones')]
    public function index(): Response
    {
        return $this->render('telephones/index.html.twig', [
            'controller_name' => 'TelephonesController',
        ]);
    }

    #[Route("/ajout/ajax/{label}", name: 'app_prenoms_ajout_ajax', methods: ['POST'])]
    public function ajoutAjax(string $label, Request $request, EntityManagerInterface $entityManager): Response
    {
        $telephone = new Telephones();
        $telephone->setNumero(trim(strip_tags($label)));
        $entityManager->persist($telephone);
        $entityManager->flush();
        //on récupère l'Id qui a été créé
        $id = $telephone->getId();

        return new JsonResponse(['id' => $id]);
    }
}
