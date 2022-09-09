<?php

namespace App\Search\Hospital;

use App\Entity\Hospital;
use App\Entity\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HourlyHospitalSearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('hospitals', EntityType::class, ['label'=> 'Hôpital', 'class' => Hospital::class, 'multiple' => true, 'expanded' => true])
            ->add('services', EntityType::class, ['label'=> 'Services', 'class' => Service::class, 'multiple' => true, 'expanded' => true])
            ->add('submit', SubmitType::class, ['label'=>'Chercher'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'method' => 'GET',
            'csrf_protection'=> false,
            'data_class' => HourlyHospitalSearch::class,
        ]);
    }
}