<?php

namespace App\Controller\admin;

use App\Entity\Dog;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DogCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Dog::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            BooleanField::new('isAdopted', 'Adopté'),
            TextField::new('name', 'Nom'),
            TextareaField::new('description', 'Description'),
            DateField::new('dateOfBirth', 'Date de naissance'),
            TextField::new('picture','Photo'),
            AssociationField::new('annonce', 'Annonce associée'),
            AssociationField::new('breeds', 'Race'),

        ];
    }

}
