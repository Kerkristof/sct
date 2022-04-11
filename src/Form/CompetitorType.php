<?php

namespace App\Form;

use App\Entity\Competitor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\Email;

class CompetitorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', null, [
              'label' => 'Prénom',
              'attr' => [
                'required' => true,
                'type' => 'TextType',
                'class' => 'form-control',
                'placeholder' => '...'
              ]
            ])
            ->add('name', null, [
              'label' => 'Nom',
              'attr' => [
                'required' => true,
                'type' => 'TextType',
                'class' => 'form-control',
                'placeholder' => '...'
              ]
            ])
            ->add('email', null, [
              'label' => 'Adresse email',
              'attr' => [
                'required' => true,
                'type' => 'Email',
                'class' => 'form-control',
                'placeholder' => '...'
              ]
            ])
            ->add('phone', null, [
              'label' => 'Numéro de téléphone',
              'attr' => [
                'required' => true,
                'class' => 'form-control',
                'placeholder' => '...'
              ]
            ])
            ->add('adress', null, [
              'label' => 'Adresse postale',
              'attr' => [
                'required' => true,
                'class' => 'form-control',
                'placeholder' => '...'
              ]
            ])
            ->add('postal_code', null, [
              'label' => 'Code postal',
              'attr' => [
                'required' => true,
                'class' => 'form-control',
                'placeholder' => '...'
              ]
            ])
            ->add('town', null, [
              'label' => 'Ville',
              'attr' => [
                'required' => true,
                'class' => 'form-control',
                'placeholder' => '...'
              ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Competitor::class,
        ]);
    }
}
