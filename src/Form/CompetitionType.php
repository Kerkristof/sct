<?php

namespace App\Form;

use App\Entity\Competition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CompetitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('comment')
            ->add('date', DateType::class, [
              'widget' => 'single_text',
              'attr' => ['class' => 'js-datepicker form-control']
            ])
            ->add('registration_deadline', DateTimeType::class, [
              'widget' => 'single_text',
              'attr' => ['class' => 'js-datepicker js-timepicker form-control']
            ])
            ->add('active')
            ->add('team_size')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Competition::class,
        ]);
    }
}
