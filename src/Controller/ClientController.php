<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository )
    {

        $this->userRepository = $userRepository;
    }


    /**
     * @Route("/client", name="client")
     */
    public function index(): Response
    {
        return $this->render('client/index.html.twig');

    }
}
