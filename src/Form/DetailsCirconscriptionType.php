<?php

namespace App\Form;

use App\Entity\DetailsCirconscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailsCirconscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('posistionGeographique')
            ->add('nbreInscris')
            ->add('nbreSuffExprime')
            ->add('suffValable')
            ->add('suffInvalable')
            ->add('suffReparti')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DetailsCirconscription::class,
        ]);
    }
}
