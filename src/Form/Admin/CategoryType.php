<?php

namespace App\Form\Admin;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CategoryType extends AbstractType
{

    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                "label" => "Nom de la catégorie"
            ])
            ->add("subCategories", SearchableEntityType::class, [
                "class" => Category::class,
                'search' => $this->urlGenerator->generate("products"),
                "label_property" => "name",
                "value_property" => "id",
                "required" => false
            ])
            ->add("depth", IntegerType::class, [
                "label" => "profondeur"
            ])
            ->add('isParentCategory', CheckboxType::class, [
                "label" => "Catégorie parente ?",
                "required" => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
