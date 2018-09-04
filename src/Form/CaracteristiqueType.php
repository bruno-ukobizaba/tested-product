<?php

namespace App\Form;

use App\Entity\Langue;
use App\Entity\ProduitTeste;
use App\Entity\Caracteristique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CaracteristiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomChimique')
            ->add('nomCommun')
            ->add('nomCommercial')
            ->add('description', TextareaType::class)
            ->add('produitTeste', EntityType::class, [
                'class' => ProduitTeste::class,
                'choice_label' => 'IUPAC'
            ])
            ->add('langue', EntityType::class, [
                'class' => Langue::class,
                'choice_label' => 'nom'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Caracteristique::class,
        ]);
    }
}
