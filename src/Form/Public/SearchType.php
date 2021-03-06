<?php

namespace App\Form\Public;

use App\Data\SearchData;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', TextType::class, [
                "label" => false,
                "required" => false,
                "attr" => [
                    "placeholder" => "Rechercher"
                ]
            ])
            ->add("categories", EntityType::class, [
                "label" => false,
                "required" => false,
                "class" => Category::class,
                "expanded" => true,
                "multiple" => true,
                "choice_label" => "name",
                'query_builder' => function(CategoryRepository $repository) {
                    return $repository->getFiveFirstCategory();
                }
            ])
            ->add("promo", CheckboxType::class, [
                "label" => "En promotion",
                "required" => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => SearchData::class,
            "method" => "GET",
            "csrf_protection" => false
        ]);
    }

    public function getBlockPrefix(): string
    {
        return "";
    }
}