<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\BookCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('date', TextType::class, [
                'label' => 'Date de Sortie'
            ])
            ->add('author', EntityType::class, array(
                'class' => Author::class,
                'choice_label' => 'name',
                'label' => 'Auteur',
                'multiple' => false,
                'expanded' => true,
            ))
            ->add('category', EntityType::class, array(
                'class' => BookCategory::class,
                'label' => 'Categorie',
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => true,
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
