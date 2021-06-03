<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ModifierPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager )
    {
        $this->entityManager =$entityManager;
    }
    /**
     * @Route("/modifier-mom-motdepasse", name="modifier")
     */
    public function index(Request $request , UserPasswordEncoderInterface $encoder): Response
    {
        $notification =null;
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $old_pwd = $form->get('old_password')->getData() ;

            if ($encoder->isPasswordValid($user, $old_pwd))
            {
                $new_pwd = $form->get('new_password')->getData() ;
                $password = $encoder->encodePassword($user,$new_pwd);

                $user->setPassword($password);
                $this->entityManager->flush();
                $notification = 'Votre mot de passe a ete mis a jour.';
            } else
            {
                $notification='Votre mot de passe nest pas le bon';
            }

        }
        return $this->render('client/password.html.twig' , [
            'form'=>$form ->createView(),
            'notification'=>$notification
        ]);
    }
}
