<?php

namespace App\Form;

use App\Entity\Circonscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CirconscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('region')
            ->add('departement')
            ->add('arrondissement')
            ->add('commune')
            ->add('bureau')
            ->add('detailsCirconscription')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Circonscription::class,
        ]);
    }
}
