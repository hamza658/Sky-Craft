<?php

namespace App\Form;

use App\Entity\Voiture;
use App\Entity\Chauffeur;
use App\Entity\ReservationVoiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ReservationVoiture1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idVoiture',EntityType::class,[
                'class'=> Voiture::class, 'choice_label'=> 'marque'
            ] )
            
            ->add('idChauffeur', EntityType::class,[
                'class'=> Chauffeur::class, 'choice_label'=> 'prenomChauffeur'
            ] )
            ->add('dateDebut')
            ->add('dateFin')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReservationVoiture::class,
        ]);
    }
}
