<?php

namespace App\Form;

use App\Entity\Hourly;
use App\Entity\Time;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HourlyType extends AbstractType
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
            ->add('hospital', ChoiceType::class, [
                'label'=>'Hôpital',
                'choices'=>[
                    'Centre hospitalier Java'=>'Centre hospitalier Java',
                    'Php clinic'=> 'Php clinic',
                    'CHTM'=>'CHTML'
                ]
            ])
            ->add('service', ChoiceType::class,[
                'label'=>'Service',
                'choices'=> [
                    'Cardiologie'=> 'cardiologie',
                    'Neurologie'=>'Neurologie',
                    'Urgences'=>'Urgences',
                    'Pediatrie'=>'Pédiatrie'
                ]
            ])
            ->add('submit', SubmitType::class, ['label'=>'Ajouter'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hourly::class,
        ]);
    }
}
