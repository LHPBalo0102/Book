<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

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

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fas fa-book')->setCssClass('btn btn-success');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setIcon('fas fa-edit text-dark')->setCssClass('btn btn-warning text-dark');
            })
            ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action) {
                return $action->setIcon('fas fa-eye text-dark')->setCssClass('btn btn-info text-dark');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setIcon('fas fa-trash text-dark')->setCssClass('btn btn-danger text-dark');
            });
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

            yield NumberField::new('value', 'VALUE (USD)');

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

            yield NumberField::new('value', 'VALUE (USD)');

            yield AssociationField::new('type', 'TYPE');
            yield NumberField::new('quantity', 'QUANTITY');

        }

    }
}
