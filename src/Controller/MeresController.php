<?php

namespace App\Controller;

use App\Repository\MeresRepository;
use App\Repository\PeresRepository;
use App\Repository\TelephonesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/meres')]

class MeresController extends AbstractController
{
    #[Route('/', name: 'app_meres')]
    public function index(): Response
    {
        return $this->render('meres/index.html.twig', [
            'controller_name' => 'MeresController',
        ]);
    }

    #[Route("/telephones/search/ajax/{telephoneId}", name: 'app_meres_telephones_search_ajax', methods: ['GET', 'POST'])]
    public function ajoutAjax(int $telephoneId, PeresRepository $peresRepository, MeresRepository $meresRepository, Request $request, TelephonesRepository $telephonesRepository): Response
    {
        $telephone = $telephonesRepository->findOneBy(['id' => $telephoneId]);
        $pere = $peresRepository->findOneByTelephone($telephoneId);
        $mere = $meresRepository->findOneByTelephone($telephoneId);
        if ($mere !== null) {
            // Récupérez les informations nécessaires de la père pour les passer au formulaire
            $mereId = $mere->getId() ? $mere->getId() : null;
            $nomId = $mere->getNom() ? $mere->getNom()->getId() : null;
            $prenomId = $mere->getPrenom() ? $mere->getPrenom()->getId() : null;
            $professionId = $mere->getProfession() ? $mere->getProfession()->getId() : null;
            $telephoneId = $mere->getTelephone1() ? $mere->getTelephone1()->getId() : null;
            $telephone2Id = $mere->getTelephone2() ? $mere->getTelephone2()->getId() : null;

            // Récupérer les noms, prénoms et professions associés à la père
            $nom = $mere->getNom() ? $mere->getNom()->getDesignation() : null;
            $prenom = $mere->getPrenom() ? $mere->getPrenom()->getDesignation() : null;
            $profession = $mere->getProfession() ? $mere->getProfession()->getDesignation() : null;
            $telephone = $mere->getTelephone1() ? $mere->getTelephone1()->getNumero() : null;
            $telephone2 = $mere->getTelephone2() ? $mere->getTelephone2()->getNumero() : null;

            return new JsonResponse([
                'mereId' => $mereId,
                'nomId' => $nomId,
                'prenomId' => $prenomId,
                'professionId' => $professionId,
                'telephoneId' => $telephoneId,
                'telephone2Id' => $telephone2Id,
                'nom' => $nom,
                'prenom' => $prenom,
                'profession' => $profession,
                'telephone' => $telephone,
                'telephone2' => $telephone2,
            ]);
        } elseif ($mere == null && $pere !== null && $telephone !== null) {
            $pereId = $pere->getId() ? $pere->getId() : null;
            $nomId = $pere->getNom() ? $pere->getNom()->getId() : null;
            $prenomId = $pere->getPrenom() ? $pere->getPrenom()->getId() : null;
            $professionId = $pere->getProfession() ? $pere->getProfession()->getId() : null;
            $telephoneId = $pere->getTelephone1() ? $pere->getTelephone1()->getId() : null;
            $telephone2Id = $pere->getTelephone2() ? $pere->getTelephone2()->getId() : null;

            // Récupérer les noms, prénoms et professions associés à la mère
            $nom = $pere->getNom() ? $pere->getNom()->getDesignation() : null;
            $prenom = $pere->getPrenom() ? $pere->getPrenom()->getDesignation() : null;
            $profession = $pere->getProfession() ? $pere->getProfession()->getDesignation() : null;
            $telephone = $pere->getTelephone1() ? $pere->getTelephone1()->getNumero() : null;
            $telephone2 = $pere->getTelephone2() ? $pere->getTelephone2()->getNumero() : null;

            $this->addFlash('danger', 'Le téléphone sollicité pour une mère, est déjà associé à un père');
            $response = new JsonResponse([
                'errorTel' => 'Le téléphone sollicité pour une mère, est déjà associé à un père',
                'mereId' => $pereId,
                'nomId' => $nomId,
                'prenomId' => $prenomId,
                'professionId' => $professionId,
                'telephoneId' => $telephoneId,
                'telephone2Id' => $telephone2Id,
                'nom' => $nom,
                'prenom' => $prenom,
                'profession' => $profession,
                'telephone' => $telephone,
                'telephone2' => $telephone2,
            ]);
            $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', '0');
            return $response;
        } elseif ($mere == null && $pere == null && $telephone !== null) {
            return new JsonResponse([
                'errorTele' => 'Le téléphone existe, mais il n\'a pas de mère associée.',
                'telephoneId' => $telephone->getId(),
                'telephone' => $telephone->getNumero(),

                'mereId' => null,
                'nomId' => null,
                'prenomId' => null,
                'professionId' => null,
                'telephone2Id' => null,
                'nom' => null,
                'prenom' => null,
                'profession' => null,
                'telephone2' => null
            ]);
        } else {
            $numero = '+' . $telephoneId;
            $telephone = $telephonesRepository->findOneByNumero($numero);
            $telephoneId = $telephone->getId();
            // Le téléphone existe, mais il n'a pas de père associée
            return new JsonResponse([
                'error' => "ce numéro vient d'être créé !!!",
                'telephoneId' => $telephoneId,
                'telephone' => $telephone->getNumero(),

                'mereId' => null,
                'nomId' => null,
                'prenomId' => null,
                'professionId' => null,
                'telephone2Id' => null,
                'nom' => null,
                'prenom' => null,
                'profession' => null,
                'telephone2' => null
            ]);
        }
    }
}