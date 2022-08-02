<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label'=>'Nom'])
            ->add('firstname', TextType::class, ['label'=>'Prénom'])
            ->add('email', EmailType::class, ['label'=>'Email'])
            ->add('username', TextType::class, ['label'=>'Nom utilisateur'])
            ->add('job', ChoiceType::class, ['label'=>'Métier',
                'choices'=>[
                    'Aucun'=> '',
                    'Docteur'=> 'Docteur',
                    'Medecin'=>'medecin'
                ]
            ])
            ->add('specialization', ChoiceType::class, ['label'=>'Specialisation',
                'choices'=>[
                    'Aucune'=> '',
                    'Cardiologie'=> 'cardiologie',
                    'Neurologie'=>'Neurologie',
                    'Urgences'=>'Urgence',
                    'Pediatrie'=>'Pédiatrie'
                ]])
            ->add('inamiNumber', NumberType::class, ['label'=>'Numéro Inami'])
            ->add('Password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Repeter votre mot de passe'],
            ])
            ->add('submit', SubmitType::class, ['label'=> 'Envoyer'])
        ;

    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
