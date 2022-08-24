<?php

namespace App\Search\User;
use App\Entity\Hospital;
use App\Entity\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HourlySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('date',DateType::class,[
//                'label'=>'Date',
//                'widget' => 'single_text'
//            ])
            ->add('services', EntityType::class, ['label'=> 'service', 'class' => Service::class, 'multiple' => true, 'expanded' => true])
            ->add('hospitals', EntityType::class, ['label'=> 'hôpital', 'class' => Hospital::class, 'multiple' => true, 'expanded' => true])
            ->add('submit', SubmitType::class, ['label'=>'chercher'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'method' => 'GET',
            'csrf_protection'=> false,
            'data_class' => HourlySearch::class,
        ]);
    }


}