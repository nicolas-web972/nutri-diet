<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name:'home.index', methods: ['GET'])]
    public function index(): Response 
    {
        return $this->render('pages/accueil.html.twig');
    }
    
}