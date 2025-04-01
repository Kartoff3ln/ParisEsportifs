<?php

namespace App\Form;

use App\Entity\Versus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VersusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rate_team1')
            ->add('rate_team2')
            ->add('description')
            ->add('date')
            ->add('gameid', EntityType::class, [
                'class' => 'App\Entity\Game',
                'choice_label' => 'game_name', // Assurez-vous que 'nom' est le nom du champ que vous souhaitez afficher
                'choice_value' => 'id', // Assurez-vous que 'id' est le nom du champ ID
                'placeholder' => 'Sélectionnez un jeu', // Optionnel : ajout d'une option de placeholder
            ])
            ->add('team1', EntityType::class, [
                'class' => 'App\Entity\Team',
                'choice_label' => 'team_name', // Assurez-vous que 'nom' est le nom du champ que vous souhaitez afficher
                'choice_value' => 'id', // Assurez-vous que 'id' est le nom du champ ID
                'placeholder' => 'Sélectionnez une équipe', // Optionnel : ajout d'une option de placeholder
            ])
            ->add('team2', EntityType::class, [
                'class' => 'App\Entity\Team',
                'choice_label' => 'team_name', // Assurez-vous que 'nom' est le nom du champ que vous souhaitez afficher
                'choice_value' => 'id', // Assurez-vous que 'id' est le nom du champ ID
                'placeholder' => 'Sélectionnez une équipe', // Optionnel : ajout d'une option de placeholder
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Versus::class,
        ]);
    }
}
