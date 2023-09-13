<?php

namespace App\Form;

use App\Entity\Chauffeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChauffeurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomChauffeur')
            ->add('prenomChauffeur')
            ->add('cinChauffeur')
            ->add('numTelChauffeur')
            ->add('emailChauffeur')
            ->add('dateNaissanceChauffeur')
            ->add('numCompteBancaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chauffeur::class,
        ]);
    }
}
