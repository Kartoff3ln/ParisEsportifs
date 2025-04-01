<?php

namespace App\Form;

use App\Entity\Bet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class BetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $versus = $options['versus'];

        $builder
            ->add('Montant', NumberType::class, [
                'property_path' => 'amount',
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[0-9]+(?:\.[0-9]+)?$/',
                        'message' => 'Veuillez ne rentrer que des chiffres !',
                    ]),
                    new Callback([
                        'callback' => function ($value, ExecutionContextInterface $context) use ($options) {
                            $user = $options['user'];

                            if($value == 0) {
                                $context->buildViolation('Le montant parié doit être supérieur à 0 !')
                                    ->atPath('amount')
                                    ->addViolation();
                            }

                            if ($value > $user->getBalance()) {
                                $context->buildViolation('Le montant parié dépasse votre solde !')
                                    ->atPath('amount')
                                    ->addViolation();
                            }
                        },
                    ]),
                ],
            ])
            ->add('Equipe', EntityType::class, [
                'property_path' => 'teamid',
                'class' => 'App\Entity\Team',
                'choices' => [
                    $versus->getTeam1(),
                    $versus->getTeam2(),
                ],
                'choice_label' => 'team_name',
                'choice_value' => 'id',
                'placeholder' => 'Sélectionnez une équipe',
            ])
            ->add('confirmation', CheckboxType::class, [
                'label' => "En cochant cette case j'accepte de potentiellement perdre ma mise",
                'mapped' => false, // Ne pas mapper cette propriété sur l'entité Bet
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bet::class,
            'versus' => null,
            'user' => null,
        ]);

        $resolver->setAllowedTypes('versus', 'App\Entity\Versus');
    }
}
