<?php

namespace App\Controller;

use App\Repository\DogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(DogRepository $dogRepository): Response
    {
        $dogs = $dogRepository->findAll();

        return $this->render('home/index.html.twig', [
            'dogs' => $dogs,
        ]);
    }
}
