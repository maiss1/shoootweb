<?php

namespace App\Form;

use App\Entity\Matchh;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Matchh1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idEquipe1')
            ->add('idEquipe2')
            ->add('date')
            ->add('idComp')
            ->add('idStat')
            ->add('idProno')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Matchh::class,
        ]);
    }
}
