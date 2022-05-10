<?php

namespace App\Form;

use App\Entity\Statistique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Statistique1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titrematch')
            ->add('but')
            ->add('nButeur')
            ->add('nPasseur')
            ->add('nbCorner')
            ->add('nbFaute')
            ->add('nbCarton')
            ->add('idMatch')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Statistique::class,
        ]);
    }
}
