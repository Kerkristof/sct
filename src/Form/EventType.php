<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\EventCategory;


class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('date', DateType::class, [
              'widget' => 'single_text',
              'attr' => ['class' => 'js-datepicker form-control']
            ])
            ->add('category', EntityType::class, [
            'class' => EventCategory::class,
            'choices' => $options['categoryList'],
            'choice_label' => 'title'
          ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
            'categoryList' => []
        ]);
    }
}
