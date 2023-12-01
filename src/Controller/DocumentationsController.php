<?php

namespace App\Controller;

use App\Services\PdfUploader;
use App\Entity\Documentations;
use App\Form\DocumentationsType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DocumentationsRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\DocumentCategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/documentations')]
class DocumentationsController extends AbstractController
{
    #[Route('/', name: 'app_documentations_index', methods: ['GET'])]
    public function index(DocumentationsRepository $documentationsRepository): Response
    {
        return $this->render('documentations/index.html.twig', [
            'documentations' => $documentationsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_documentations_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, PdfUploader $pdfUploader ): Response
    {
        $documentation = new Documentations();
        $form = $this->createForm(DocumentationsType::class, $documentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('pdf')->getData();

            if ($file) {
                $fileName = $pdfUploader->uploadPDF($form, $documentation);
            }

            $pdf = $form->get('pdf')->getData();
            if (isset($profimg)) {
                $errorMessage =$pdfUploader->uploadPDF($form, $documentation);
                if (!empty($errorMessage)) {
                    $this->addFlash('danger', 'An error has occurred: ' . $errorMessage);
                }
                $userRepository->save($user, true);
            }

            $entityManager->persist($documentation);
            $entityManager->flush();

            return $this->redirectToRoute('app_documentations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('documentations/new.html.twig', [
            'documentation' => $documentation,
            'form' => $form,
        ]);
    }

    #[Route('/doc/{id}', name: 'app_documentation_show')]
    public function show($id, DocumentationsRepository $documentationsRepository, DocumentCategoryRepository $documentCategoryRepository): Response
    {
        $category = $documentCategoryRepository->find($id); // Remplacez par le moyen de récupérer votre catégorie
    
        if (!$category) {
            throw $this->createNotFoundException('Category not found');
        }
    
        $documentations = $documentationsRepository->findBy(['category' => $category]);
    
        return $this->render('documentations/show.html.twig', [
            'category' => $category,
            'documentations' => $documentations,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_documentations_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Documentations $documentation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DocumentationsType::class, $documentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_documentations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('documentations/edit.html.twig', [
            'documentation' => $documentation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_documentations_delete', methods: ['POST'])]
    public function delete(Request $request, Documentations $documentation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$documentation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($documentation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_documentations_index', [], Response::HTTP_SEE_OTHER);
    }

}
