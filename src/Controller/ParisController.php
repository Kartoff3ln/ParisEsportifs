<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParisController extends AbstractController
{
    #[Route('/paris', name: 'app_paris')]
    public function index(): Response
    {
        return $this->render('paris/index.html.twig', [
            'controller_name' => 'ParisController',
        ]);
    }
}
