<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BookCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Book::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('BOOK LIST')
            ->setEntityLabelInPlural('BOOKS LIST');
    }

    public function configureFields(string $pageName): iterable
    {
        if (Crud::PAGE_EDIT === $pageName) {
            yield TextField::new('code', 'CODE')
                ->setFormTypeOption('disabled', 'disabled');
            yield TextField::new('book', 'BOOK')
                ->setFormTypeOption('disabled', 'disabled');
            yield TextField::new('author', 'AUTHOR')
                ->setFormTypeOption('disabled', 'disabled');
            yield ChoiceField::new('publisher', 'PUBLISHER')
                ->setChoices([
                    'Kim Dong' => 'Kim Dong',
                    'Tre' => 'Tre'
                ])
                ->setFormTypeOption('disabled', 'disabled');

            yield MoneyField::new('value', 'VALUE')
                ->setCurrency('USD')
                ->setFormTypeOption('disabled', 'disabled');

            yield AssociationField::new('type', 'TYPE')
                ->setFormTypeOption('disabled', 'disabled');
        } else {
            yield TextField::new('code', 'CODE');
            yield TextField::new('book', 'BOOK');
            yield TextField::new('author', 'AUTHOR');

            yield ChoiceField::new('publisher', 'PUBLISHER')
                ->setChoices([
                    'Kim Dong' => 'Kim Dong',
                    'Tre' => 'Tre'
                ]);

            yield MoneyField::new('value', 'VALUE')
                ->setCurrency('USD');

            yield AssociationField::new('type', 'TYPE');
            yield NumberField::new('quantity', 'QUANTITY');

        }

    }
}
