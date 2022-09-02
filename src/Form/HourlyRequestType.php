<?php

namespace App\Form;

use App\Entity\HourlyRequest;
use App\Entity\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HourlyRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date',DateType::class,[
                'label'=>'Date',
                'widget' => 'single_text'
            ])
            ->add('hour',ChoiceType::class,[
                'label'=>'Pause',
                'choices'=>[
                    '8h00-18h00'=>'8h00-18h00',
                    '8h00-20h00'=>'8h00-20h00',
                    '12h30-22h30'=>'12h30-22h30',
                    '22h00-8h30'=>'22h00-8h30'

                ]])
            ->add('service', EntityType::class, ['class' => Service::class])
            ->add('submit', SubmitType::class, ['label'=>'Envoyer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HourlyRequest::class,
        ]);
    }
}
