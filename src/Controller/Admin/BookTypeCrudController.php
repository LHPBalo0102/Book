<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Entity\BookType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\ChoiceList\ChoiceList;

class BookTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BookType::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('BOOK TYPE')
            ->setEntityLabelInPlural('BOOK TYPES');
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('code', 'CODE');
        yield TextField::new('type', 'TYPE');
    }
}
