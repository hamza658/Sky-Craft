<?php

namespace App\Form;

use App\Entity\Evenment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('detail',TextType::class)
            ->add('dateDebut', DateTimeType::class, [
                'date_label' => 'Starts On'])
            ->add('dateFin', DateTimeType::class, [
                'date_label' => 'Starts On'])

            ->add('dureeEv',TextType::class)
            ->add('commentaire', TextType::class)
            ->add('image',FileType::class,[ 'mapped' => false])

            ->add('Submit', SubmitType::class,
                ['label' => 'Ajouter'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenment::class,
        ]);
    }
}
