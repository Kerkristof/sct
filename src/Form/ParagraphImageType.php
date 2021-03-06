<?php

namespace App\Form;

use App\Entity\ParagraphImage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParagraphImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
              'label' => 'Titre',
              'attr' => [
                'class' => 'form-control'
              ]
            ])
            ->add('imageFile', FileType::class, [
              'label' => 'Image',
              'required' => true,
              'attr' => [
                'class' => 'form-control'
              ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ParagraphImage::class,
        ]);
    }
}
