<?php

namespace App\Controller\admin;

use App\Entity\Annonce;
use App\Repository\DogRepository;
use ContainerI1AOnMP\getFieldCollectionService;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Configurator\AssociationConfigurator;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use Symfony\Component\DomCrawler\Field\FileFormField;

class AnnonceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Annonce::class;
    }

/*    public function configureCrud(Crud $crud): Crud
    {

    }*/

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title', 'Titre'),
            AssociationField::new('dogs', 'Chiens'),
            UrlField::new('picture', 'Image'),
        ];
    }

}
