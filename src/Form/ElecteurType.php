<?php

namespace App\Form;

use App\Entity\Electeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ElecteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cni')
            ->add('nom')
            ->add('prenom')
            ->add('dateNaiss')
            ->add('adresse')
            ->add('nomCentreVote')
            ->add('numBureauVote')
            ->add('circonscription')
            ->add('candidat')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Electeur::class,
        ]);
    }
}
