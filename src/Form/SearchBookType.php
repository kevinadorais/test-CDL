<?php

namespace App\Form;

use App\Data\SearchBook;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchBookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'required' => false
            ])
            ->add('date', NumberType::class, [
                'label' => 'Date',
                'required' => false
            ])
            ->add('author', TextType::class, [
                'label' => 'Auteur',
                'required' => false
            ])
            ->add('authorBirthDate', ChoiceType::class, [
                'label' => 'Naissance Auteur',
                'multiple' => false,
                'expanded' => true,
                'choices' => [
                    '1900' => '01/01/1900',
                    '1970' => '01/01/1960',
                    '1980' => '01/01/1970'
                ]
            ])
            ->add('category', ChoiceType::class, [
                'label' => 'Categorie',
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'Roman' => 'Roman',
                    'BD' => 'BD',
                    'Manga' => 'Manga'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchBook::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return parent::getBlockPrefix();
    }
}
