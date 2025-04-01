<?php

namespace App\Form;

use App\Entity\Message;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Security\Core\Security;

class MessageType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $this->security->getUser();

        $email = $user instanceof User? $user->getEmail() : null;

        $builder
            ->add('object', ChoiceType::class, [
                'choices'  => [
                    'Problème 1' => 'Problème 1',
                    'Problème 2' => 'Problème 2',
                    'Problème 3' => 'Problème 3',
                ],
            ])

            ->add('email', EmailType::class, [
                'property_path' => 'email',
                'data' => $email, // Préremplir avec l'email de l'utilisateur ou laisser vide
                'constraints' => [
                    new Email([
                        'message' => 'Veuillez rentrer une adresse mail valide !',
                    ]),
                ],
            ])

            ->add('content', TextType::class, [
                'property_path' => 'content',
                'constraints' => [
                    new Length([
                        'max' => 1500,
                        'maxMessage' => 'Votre message ne peut pas dépasser 1500 caractères !',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
