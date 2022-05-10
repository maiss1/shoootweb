<?php

namespace App\Form;

use App\Entity\Joueur;
use App\Entity\Equipe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class JoueurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomJoueur')
            ->add('datenaiss')
            ->add('age')
            ->add('pays')
            ->add('drapeau', FileType::class,[
                'label' => "insérer drapeau",
                'data_class'=> null,
                'mapped' => true,
                'required' => false
               
            ])
            ->add('image', FileType::class,[
                'label' => "insérer image",
                'data_class'=> null,
                'mapped' => true,
                'required' => false
               
            ])
            ->add('nomEquipe')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Joueur::class,
        ]);
    }
}
