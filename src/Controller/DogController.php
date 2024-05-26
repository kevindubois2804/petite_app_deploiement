<?php

namespace App\Controller;

use App\Repository\DogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DogController extends AbstractController
{
    #[Route('/dog/{name}', name: 'app_dog')]
    public function index(DogRepository $dogRepository, $name): Response
    {
        $dog = $dogRepository->findOneByName($name);
        return $this->render('dog/index.html.twig', [
            'dog' => $dog,
        ]);
    }
}
