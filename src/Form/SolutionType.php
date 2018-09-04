<?php

namespace App\Form;

use App\Entity\Langue;
use App\Entity\Solution;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SolutionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('isActive', ChoiceType::class, [
                'label' => 'Active',
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ]
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
            'data_class' => Solution::class,
        ]);
    }
}
