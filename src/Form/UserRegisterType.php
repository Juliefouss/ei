<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
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
            ->add('job', ChoiceType::class, ['label'=> 'Titre', 'choices'=>[
                'Docteur'=> 'Docteur',
                'Professeur'=> 'Professeur',
                 'Aucun'=> 'Non applicable'
            ]])
            ->add('specialization', ChoiceType::class, ['label'=>'Specialisation',
                'choices'=>[
                    'Aucune'=> 'non applicable',
                    'Cardiologie'=> 'cardiologie',
                    'Neurologie'=>'Neurologie',
                    'Urgences'=>'Urgences',
                    'Pediatrie'=>'Pédiatrie',
                    'Oncologie' => 'Oncologie'
                ]])
            ->add('inamiNumber', NumberType::class, ['label'=>'Numéro Inami'])
            ->add('Password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Répeter votre mot de passe'],
            ])
            ->add('photo', PhotoType::class, ['label'=> 'Photo'])
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
