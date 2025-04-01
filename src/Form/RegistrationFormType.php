<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'property_path' => 'name',
                'constraints' => [
                    new Length([
                        'max' => 50,
                        'maxMessage' => 'Votre nom ne peut pas dépasser 50 caractères !',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z ]+$/',
                        'message' => 'Veuillez ne rentrer que les lettres !',
                    ]),
                ],
            ])

            ->add('firstname', TextType::class, [
                'property_path' => 'firstname',
                'constraints' => [
                    new Length([
                        'max' => 50,
                        'maxMessage' => 'Votre prénom ne peut pas dépasser 50 caractères !',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-ZÀ-ÿ]+$/u',
                        'message' => 'Veuillez ne rentrer que les lettres !',
                    ]),
                ],
            ])

            ->add('pseudo', TextType::class, [
                'property_path' => 'pseudo',
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'minMessage' => 'Votre Speudo doit  au moins contenir 5 caractères !',
                        'max' => 20,
                        'maxMessage' => 'Votre Speudo ne peut pas dépasser 20 caractères !',
                    ]),
                ],
            ])

            ->add('phone_number', TextType::class, [
                'property_path' => 'phone_number',
                'constraints' => [
                    new Regex([
                        'pattern' => '/^\d{10}$/',
                        'message' => 'Le numéro de téléphone doit être composé de 10 chiffres !',
                    ]),
                ],
            ])

            ->add('email', EmailType::class, [
                'property_path' => 'email',
                'constraints' => [
                    new Email([
                        'message' => 'Veuillez rentrer une adresse mail valide !',
                    ]),
                ],
            ])

            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 25,
                    ]),
                ],
            ])

            ->add('img_file', VichFileType::class, [
                'label' => 'Photo de profil',
                'required' => false,
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
