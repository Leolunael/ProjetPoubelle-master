<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendrierSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('adresse', TextType::class, [
            'label' => 'Votre adresse',
            'required' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false, // facultatif mais utile ici
        ]);
    }

    public function getBlockPrefix(): string
    {
        return ''; // ← sans ça, le champ s'appelle calendrier_search[adresse]
    }
}

