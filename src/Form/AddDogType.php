<?php

namespace App\Form;

use App\Entity\Annonce;
use App\Entity\Breed;
use App\Entity\Dog;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddDogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $yearsAvailable=[];
        for ($i = 2000; $i <= (new \DateTime())->format('Y'); $i++) {
            $yearsAvailable[$i] = $i;
        }

        $builder
            ->add('name',
            TextType::class,
                ['label' => 'Nom']
            )

            ->add('dateOfBirth',
            DateType::class,
                [
                    'label' => 'Date de naissance',
                    'years' => $yearsAvailable
                ]
            )

            ->add('isAdopted',
                CheckboxType::class,
                [
                    'label'    => 'Ce chien est adopté ',
                    'required' => false,
                ]
            )
            ->add('description',
                TextareaType::class,
                ['label' => 'Description']

            )
            ->add('picture',
                TextType::class,
                ['label' => 'Photo']
            )
            ->add('annonce',
                EntityType::class,
            [
              'class' => Annonce::class,
                'choice_label' => 'title',
                'label' => 'Annonce associée'
            ]
            )

            ->add('breeds',
                EntityType::class,
                [
                    'class' => Breed::class,
                    'choice_label' => 'name',
                    'multiple' => true,
                    'label' => 'Race'
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dog::class,
        ]);
    }
}
