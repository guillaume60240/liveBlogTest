<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Votre adresse mail *',
                'constraints' => [new Length([
                    'min' => 5,
                    'max' => 180,
                    'minMessage' => 'Votre adresse mail doit faire au moins 5 caractères',
                    'maxMessage' => 'Votre adresse mail ne peut pas faire plus de 180 caractères',
                ]), new Email([
                    'message' => 'Votre adresse mail n\'est pas valide',
                ])
                ],
                'attr' => [
                    'placeholder' => 'Votre adresse mail',
                ],
            ])
            ->add('firstName', TextType::class, [
                'required' => true,
                'label' => 'Votre prénom *',
                'constraints' => [new Length([
                    'min' => 2,
                    'max' => 255,
                    'minMessage' => 'Votre prénom doit faire au moins 2 caractères',
                    'maxMessage' => 'Votre prénom ne peut pas faire plus de 255 caractères',
                ])
                ],
                'attr' => [
                    'placeholder' => 'Votre prénom',
                ],
            ])
            ->add('lastName', TextType::class, [
                'required' => true,
                'label' => 'Votre nom *',
                'constraints' => [new Length([
                    'min' => 2,
                    'max' => 255,
                    'minMessage' => 'Votre nom doit faire au moins 2 caractères',
                    'maxMessage' => 'Votre nom ne peut pas faire plus de 255 caractères',
                ])
                ],
                'attr' => [
                    'placeholder' => 'Votre nom',
                ],
            ])
            
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent correspondre',
                'required' => true,
                'first_options'  => ['label' => 'Votre mot de passe *'],
                'second_options' => ['label' => 'Confirmez votre mot de passe *'],
                'attr' => [
                    'placeholder' => 'Votre mot de passe',
                ],
            ])
            ->add('checkbox', CheckboxType::class, [
                'mapped' => false,
                'required' => true,
                'label' => 'J\'ai lu et j\'accepte les conditions générales d\'utilisation *',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
