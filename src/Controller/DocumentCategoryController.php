<?php

namespace App\Controller;
use Imagick;
use App\Entity\DocumentCategory;
use App\Form\DocumentCategoryType;
use App\Services\ImageUploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\DocumentCategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/documentcategory')]
class DocumentCategoryController extends AbstractController
{
    #[Route('/', name: 'app_document_category_index', methods: ['GET'])]
    public function index(DocumentCategoryRepository $documentCategoryRepository): Response
    {
        return $this->render('document_category/index.html.twig', [
            'document_categories' => $documentCategoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_document_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, DocumentCategoryRepository $documentCategoryRepository, ImageUploaderHelper $imageUploaderHelper): Response
    {
        $documentCategory = new DocumentCategory();
        $form = $this->createForm(DocumentCategoryType::class, $documentCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profimg = $form->get('img')->getData();

            if ($profimg) {
                dump("1");
                $fileName = $imageUploaderHelper->uploadImage($form, $documentCategory);
                dump($fileName);
                // $documentCategoryRepository->save($documentCategory, true);
            }

            // if (isset($profimg)) {
            //     dump("2");
            //     $errorMessage =$imageUploaderHelper->uploadImage($form, $documentCategory);
            //     if (!empty($errorMessage)) {
            //         $this->addFlash('danger', 'An error has occurred: ' . $errorMessage);
            //     }
            //     $documentCategoryRepository->save($documentCategory, true);
            // }
            dump("3");
            $entityManager->persist($documentCategory);
            $entityManager->flush();

            return $this->redirectToRoute('app_documentations_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->render('document_category/new.html.twig', [
            'document_category' => $documentCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_document_category_show', methods: ['GET'])]
    public function show(DocumentCategory $documentCategory): Response
    {
        return $this->render('document_category/show.html.twig', [
            'document_category' => $documentCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_document_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DocumentCategory $documentCategory, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DocumentCategoryType::class, $documentCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_document_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('document_category/edit.html.twig', [
            'document_category' => $documentCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_document_category_delete', methods: ['POST'])]
    public function delete(Request $request, DocumentCategory $documentCategory, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$documentCategory->getId(), $request->request->get('_token'))) {
            $entityManager->remove($documentCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_document_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
