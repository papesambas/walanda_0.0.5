<?php

namespace App\Controller;

use App\Entity\Parents;
use App\Form\ParentsType;
use App\Form\ParentsRechercheType;
use App\Repository\MeresRepository;
use App\Repository\ParentsRepository;
use App\Repository\PeresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/parents')]
class ParentsController extends AbstractController
{
    #[Route('/', name: 'app_parents_index', methods: ['GET'])]
    public function index(ParentsRepository $parentsRepository): Response
    {
        return $this->render('parents/index.html.twig', [
            'parents' => $parentsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_parents_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PeresRepository $peresRepository, MeresRepository $meresRepository, ParentsRepository $parentsRepository, EntityManagerInterface $entityManager): Response
    {
        $parent = new Parents();
        $form = $this->createForm(ParentsRechercheType::class, $parent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pereTelephone = $form->getData()->getpere()->gettelephone1();
            $mereTelephone = $form->getData()->getmere()->gettelephone1();
            $pere = $peresRepository->findOneByTelephone($pereTelephone);
            $mere = $meresRepository->findOneByTelephone($mereTelephone);
            if ($pere && $mere) {
                $parents = $parentsRepository->findOneByPereAndMere($pere, $mere);
                if ($parents) {
                    $parent = $parents;
                    $entityManager->flush();

                    // Récupérer l'ID du parent nouvellement créé
                    $parentId = $parent->getId();

                    // Rediriger vers app_eleves_new en passant l'ID du parent en paramètre
                    //return $this->redirectToRoute('app_eleves_new', ['parent_id' => $parentId], Response::HTTP_SEE_OTHER);
                    return $this->redirectToRoute('app_parents_index', [], Response::HTTP_SEE_OTHER);
                } else {
                    $parent->setPere($pere);
                    $parent->setMere($mere);
                    $entityManager->persist($parent);
                    $entityManager->flush();
                    // Récupérer l'ID du parent nouvellement créé
                    $parentId = $parent->getId();

                    // Rediriger vers app_eleves_new en passant l'ID du parent en paramètre
                    //return $this->redirectToRoute('app_eleves_new', ['parent_id' => $parentId], Response::HTTP_SEE_OTHER);
                    return $this->redirectToRoute('app_parents_index', [], Response::HTTP_SEE_OTHER);
                }
            } elseif (!$pere && $mere) {
                $parent->setMere($mere);
                $entityManager->persist($parent);
                $entityManager->flush();
                // Récupérer l'ID du parent nouvellement créé
                $parentId = $parent->getId();

                // Rediriger vers app_eleves_new en passant l'ID du parent en paramètre
                //return $this->redirectToRoute('app_eleves_new', ['parent_id' => $parentId], Response::HTTP_SEE_OTHER);
                return $this->redirectToRoute('app_parents_index', [], Response::HTTP_SEE_OTHER);
            } elseif ($pere && !$mere) {
                $parent->setPere($pere);
                $entityManager->persist($parent);
                $entityManager->flush();
                // Récupérer l'ID du parent nouvellement créé
                $parentId = $parent->getId();

                // Rediriger vers app_eleves_new en passant l'ID du parent en paramètre
                //return $this->redirectToRoute('app_eleves_new', ['parent_id' => $parentId], Response::HTTP_SEE_OTHER);
                return $this->redirectToRoute('app_parents_index', [], Response::HTTP_SEE_OTHER);
            } else {
                $entityManager->persist($parent);
                $entityManager->flush();
                // Récupérer l'ID du parent nouvellement créé
                $parentId = $parent->getId();

                // Rediriger vers app_eleves_new en passant l'ID du parent en paramètre
                //return $this->redirectToRoute('app_eleves_new', ['parent_id' => $parentId], Response::HTTP_SEE_OTHER);
                return $this->redirectToRoute('app_parents_index', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->render('parents/new.html.twig', [
            'parent' => $parent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_parents_show', methods: ['GET'])]
    public function show(Parents $parent): Response
    {
        return $this->render('parents/show.html.twig', [
            'parent' => $parent,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_parents_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Parents $parent, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParentsType::class, $parent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_parents_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('parents/edit.html.twig', [
            'parent' => $parent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_parents_delete', methods: ['POST'])]
    public function delete(Request $request, Parents $parent, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $parent->getId(), $request->request->get('_token'))) {
            $entityManager->remove($parent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_parents_index', [], Response::HTTP_SEE_OTHER);
    }
}