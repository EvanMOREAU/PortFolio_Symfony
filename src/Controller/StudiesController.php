<?php

namespace App\Controller;

use App\Entity\Studies;
use App\Form\StudiesType;
use App\Repository\StudiesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/studies', name: 'app_studies')]
class StudiesController extends AbstractController
{
    #[Route('/', name: 'app_studies_index', methods: ['GET'])]
    public function index(StudiesRepository $studiesRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN');

        return $this->render('studies/index.html.twig', [
            'studies' => $studiesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_studies_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN');

        $study = new Studies();
        $form = $this->createForm(StudiesType::class, $study);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($study);
            $entityManager->flush();

            return $this->redirectToRoute('app_studies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('studies/new.html.twig', [
            'study' => $study,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_studies_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Studies $study, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN');

        $form = $this->createForm(StudiesType::class, $study);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_studies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('studies/edit.html.twig', [
            'study' => $study,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_studies_delete', methods: ['POST'])]
    public function delete(Request $request, Studies $study, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN');
        
        if ($this->isCsrfTokenValid('delete'.$study->getId(), $request->request->get('_token'))) {
            $entityManager->remove($study);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_studies_index', [], Response::HTTP_SEE_OTHER);
    }
}
