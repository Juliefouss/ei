<?php

namespace App\Form;

use App\Entity\Hospital;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HospitalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextareaType::class, ['label'=>'Nom hôpital'])
            ->add('Adress', TextareaType::class,['label'=> 'adresse hôpital'])
            ->add('PostalCode', NumberType::class,['label'=> 'code postal'])
            ->add('Town', TextareaType::class,['label'=> 'Ville'])
            ->add('PhoneNumber', TextareaType::class, ['label'=> 'Numéro de téléphone'])
            ->add('email', EmailType::class, ['label'=> 'Email'])
            ->add('applyMail', EmailType::class, ['label'=>'Adresse mail pour postuler'])
            ->add('submit', SubmitType::class, ['label'=>'Envoyer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hospital::class,
        ]);
    }
}
