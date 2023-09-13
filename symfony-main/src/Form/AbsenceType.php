<?php

namespace App\Form;


use App\Entity\Absence;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbsenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder


            ->add('id', EntityType::class, ['class'=>'App\Entity\User', 'choice_label'=>'username'])
            ->add('etatAbsence',TextType::class,['attr'=>['placeholder'=>'etatAbsence']])
            ->add('dateAb', DateTimeType::class, [
                'time_label' => 'Starts On'])
            ->add('finAb', DateTimeType::class, [
                'time_label' => 'Starts On'])






            ->add('Submit', SubmitType::class,
                ['label' => 'Ajouter'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Absence::class,
        ]);
    }
}