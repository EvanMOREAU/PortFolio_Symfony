<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/studies', name: 'app_studies')]
class StudiesController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('studies/index.html.twig', [
            'controller_name' => 'StudiesController',
        ]);
    }
}
