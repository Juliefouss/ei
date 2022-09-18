<?php

namespace App\Form;

use App\Entity\AdminMessage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminMessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numberHourly',NumberType::class, ['label' => 'Numéro annonce'] )
            ->add('hospitalName', TextType::class, ['label'=> 'Nom de l\'hopital'])
            ->add('serviceName', TextType::class, ['label' => 'Nom du service'])
            ->add('message', TextType::class, ['label' => 'Votre message'])
            ->add('submit', SubmitType::class, ['label'=> 'Envoyer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AdminMessage::class,
        ]);
    }
}
