<?php

namespace App\Form;

use App\Entity\CentreRecyclage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType; 
use Symfony\Component\OptionsResolver\OptionsResolver;

class CentreRecyclageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('adresse')
            ->add('latitude')
            ->add('longitude')
            ->add('horaires')
            ->add('description')
            ->add('typesDechets', ChoiceType::class, [
                'label' => 'Types de déchets acceptés',
                'choices' => [
                    'Verre' => 'verre',
                    'Papier' => 'papier',
                    'Plastique' => 'plastique',
                    'Déchets verts' => 'verts',
                    'Électronique' => 'electronique',
                    'Métal' => 'métal',
                ],
                'multiple' => true,
                'expanded' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CentreRecyclage::class,
        ]);
    }
}
