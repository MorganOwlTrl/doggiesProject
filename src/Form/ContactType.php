<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Dog;
use ContainerKxx3fB1\getDogRepositoryService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('subject')
            ->add(
                'dog',
                EntityType::class,
                [
                    'class' => Dog::class,
                    'choice_label' => 'name',
                    'required' => false
                ]
            )
            ->add(
                'message',
                TextareaType::class
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
