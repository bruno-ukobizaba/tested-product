<?php

namespace App\Form;

use App\Entity\Langue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class LangueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('label')
            ->add('urlImage')
            ->add('isActive', ChoiceType::class, [
                'label'=>'Langue active',
                'choices' => [
                    'Oui'=>true, 
                    'Non'=>false
                    ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Langue::class,
        ]);
    }
}
