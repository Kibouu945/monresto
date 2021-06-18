<?php

namespace App\Controller;

use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilController extends AbstractController
{
    /**
     * @Route("/", name="acceuil")
     */
    public function index(PlatRepository $platRepository): Response
    {
        return $this->render('acceuil/index.html.twig', [
            "plats"=>$platRepository->findByRestaurant($this->getUser())
        ]);
    }
}
