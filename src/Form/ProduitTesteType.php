<?php

namespace App\Form;

use App\Entity\Solution;
use App\Entity\Dangerosite;
use App\Entity\ProduitTeste;
use App\Entity\Caracteristique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProduitTesteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('IUPAC', null, [
                'label' => 'Quel est l\'IUPAC du produit ?',
            ])
            ->add('numeroCAS', null, [
                'label' => 'Quel est le numéro CAS du produit ?',
            ])
            ->add('isMelange', ChoiceType::class, [
                'label' => 'Ce produit est-il un mélange ?',
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ]
            ])
            ->add('isTested', ChoiceType::class, [
                'label' => 'Ce produit a-t-il été testé ?',
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ]
            ])
            ->add('isActive', ChoiceType::class, [
                'label' => 'La fiche du produit est-elle visible ?',
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ]
            ])
            ->add('dangerosite', EntityType::class, [
                'label' => 'Quel danger représente ce produit ?',
                'class' => Dangerosite::class,
                'choice_label' => 'phraseRisque'
            ])
            ->add('solution', EntityType::class, [
                'label' => 'Quelle est la solution recommandée ?',
                'class' => Solution::class,
                'choice_label' => 'nom'
            ])
            ->add('caracteristiques', CollectionType::class, [
                'label' => 'Quelles sont les caractéristiques du produit ?',
                'entry_type' => CaracteristiqueType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProduitTeste::class,
        ]);
    }
}
