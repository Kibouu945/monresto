<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InscriptionController extends AbstractController
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {

        $this->encoder = $encoder;
    }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(Request $request ): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $user ->setPassword($this -> encoder -> encodePassword($user , $user->getPassword()));

            if ($user ->getType() )
            {
                $user->setRoles(["ROLE_CLIENT"]);
            }
            elseif ($user->getType() )
            {
                $user->setRoles(["ROLE_RESTAURANT"]);
            }
            else
            {
                $user->setRoles(["ROLE_LIVREUR"]);
            }

            $entitymanager = $this->getDoctrine()->getManager();
            $entitymanager -> persist($user);

            $entitymanager ->flush();
            return $this->redirectToRoute('app_login');

        }


        return $this->render('inscription/index.html.twig',[
            'form'=>$form->createView()
        ]);
    }


}
