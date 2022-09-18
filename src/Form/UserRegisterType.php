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
use Symfony\Component\Validator\Constraints\Blank;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UserRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label'=>'Nom'])
            ->add('firstname', TextType::class, ['label'=>'Prénom'])
            ->add('email', EmailType::class, ['label'=>'Email'])
            ->add('job', ChoiceType::class, ['label'=> 'Titre', 'choices'=>[
                'Docteur'=> 'Docteur',
                'Professeur'=> 'Professeur',
                 'Aucun'=> 'Non applicable'
            ]])
            ->add('specialization', ChoiceType::class, ['label'=>'Qualification',
                'choices'=>[
                    'Aucune'=> '',
                    'Cardiologie'=> 'cardiologie',
                    'Neurologie'=>'Neurologie',
                    'Urgences'=>'Urgences',
                    'Pediatrie'=>'Pédiatrie',
                    'Oncologie' => 'Oncologie',
                    'Gynécologie'=> 'Gynecologie',
                    'Gastroentérologie' => 'Gastroentérologie',
                    'Endocrinologie' => 'Endocrinologie',
                    'Pneumologie' => 'Pneumologie',
                    'Infectiologie'=> 'Infectiologie',
                    'Néphrologie'=> 'Néphrologie',
                    'Urologie'=>'Urologie',
                    'Néonatologie'=> 'Néonatologie',
                    'ORL'=> 'ORL',
                    'Physiologie'=>'Physiologie'
                ]])
            ->add('inamiNumberPart1', NumberType::class, [
                'label' => ' ',
                'constraints' => [
                    new NotBlank(),
                    new Regex('/([0-9]{1})/')
                ],
                ])
            ->add('inamiNumberPart2', NumberType::class, [
                'label' => ' ',
                'constraints' => [
                    new NotBlank(),
                    new Regex('/[0-9]{5}/')
                ]
            ])
            ->add('inamiNumberPart3', NumberType::class, [
                'label' => ' ',
                'constraints' => [
                    new NotBlank(),
                    new Regex('/[0-9]{2}/')
                ]
            ])->add('inamiNumberPart4', NumberType::class, [
                'label' => ' ',
                'constraints' => [
                    new NotBlank(),
                    new Regex('/[0-9]{3}/')
                ]
            ])
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
