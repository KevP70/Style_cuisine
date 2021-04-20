<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\ImageAfter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageAfterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('images', FileType::class, [
                'label'=> 'Choisir votre image "Après"',
            ])
            ->add('categories', EntityType::class, [
                'class'  => Categories::class,
                'choice_label' => 'name',
                'label' => 'Choisir la catégorie ',
                'multiple' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ImageAfter::class,
        ]);
    }
}
