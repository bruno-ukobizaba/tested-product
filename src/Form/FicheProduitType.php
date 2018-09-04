<?php

namespace App\Form;

use App\Entity\Caracteristique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FicheProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('IUPAC')
        ->add('numeroCAS')
        ->add('isMelange', ChoiceType::class, [
            'label' => 'Active',
            'choices' => [
                'Oui' => true,
                'Non' => false
            ]
        ])
        ->add('isTested', ChoiceType::class, [
            'label' => 'Active',
            'choices' => [
                'Oui' => true,
                'Non' => false
            ]
        ])
        ->add('isActive', ChoiceType::class, [
            'label' => 'Active',
            'choices' => [
                'Oui' => true,
                'Non' => false
            ]
        ])
        ->add('nomChimique')
        ->add('nomCommun')
        ->add('nomCommercial')
        ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
