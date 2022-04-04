<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Votre Nom',
                'attr' => [
                    'placeholder' => ' Merci de saisir votre nom'
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Votre Prénom',
                'attr' => [
                    'placeholder' => ' Merci de saisir votre prénom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre Email',
                'attr' => [
                    'placeholder' => ' Merci de saisir votre adresse mail'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Votre Message',
                'attr' => [
                    'placeholder' => ' En quoi pouvons-nous vous aider'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' =>'btn-block btn-success'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
