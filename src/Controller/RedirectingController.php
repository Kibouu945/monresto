<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RedirectingController extends AbstractController
{
    /**
     * @Route("/redirecting", name="redirecting")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        if(in_array('ROLE_ADMIN', $user->getRoles()) )
        {
            return $this->redirectToRoute('admin');
        }
        elseif ( in_array('ROLE_CLIENT', $user->getRoles()))
        {
            return $this->redirectToRoute('client');
        }
        elseif (in_array('ROLE_RESTAURANT', $user->getRoles()))
        {
            return $this->redirectToRoute('restaurant');
        }
        else
        {
            return $this->redirectToRoute('livreur');
        }
    }
}
