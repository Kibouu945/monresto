<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled'=>true,
                'label'=>'Mon adresse email'
            ])

            ->add('nom', TextType::class, [
                'disabled'=>true,
                'label'=>'Mon nom'
            ])
            ->add('prenoms', TextType::class, [
                'disabled'=>true,
                'label'=>'Mon prenom'
            ])
            ->add('old_password', PasswordType::class, [
                'label'=>'Mon mot de passe actuel',
                'mapped'=>false,
                'attr'=>[
                    'placeholder'=>'Veuillez saisir votre mot de passe actuel'
                ]
            ])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped'=> false ,
                'invalid_message' => 'Les mots de passe doivent correspondre .',
                'label'=>'Mon nouveau mot de passe',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Mon nouveau Mot de passe'],
                'second_options' => ['label' => 'Confirmer votre mot de passe'],
            ])
            ->add('submit',SubmitType::class,[
                'label'=>"MAJ"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
