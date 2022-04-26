<?php

namespace App\Form;

use App\Entity\Equipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class EquipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomEquipe')
            ->add('pays')
            ->add('drapeau', FileType::class,[
                'label' => "insérer drapeau",
                'data_class'=> null,
                'mapped' => true,
                'required' => false
               
            ])
            ->add('logo',  FileType::class,[
                'label' => "insérer logo",
                'data_class'=> null,
                'mapped' => true,
                'required' => false
               
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipe::class,
        ]);
    }
}
