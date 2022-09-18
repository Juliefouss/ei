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
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class EditProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label'=>'Nom'])
            ->add('firstname', TextType::class, ['label'=>'Prénom'])
            ->add('email', EmailType::class, ['label'=>'Email'])
            ->add('job', ChoiceType::class, ['label'=> 'Titre', 'choices'=>[
                'Docteur'=> 'Docteur',
                'Professeur'=> 'Professeur'
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
