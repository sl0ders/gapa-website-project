<?php

namespace App\Form\Admin;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Provider;
use App\Entity\Vehicle;
use App\Entity\VehicleDeclination;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ProductType extends AbstractType
{
    /**
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('OriginalReference', TextType::class, [
                "label" => "",
                "label_attr" => ["class" => "d-none"],
                "attr" => [
                    "placeholder" => "Réference d'origine",
                    "onchange " => "handleChange(product_OriginalReference)"
                ],
                "required" => false
            ])
            ->add('reference', TextType::class, [
                "label" => "",
                "label_attr" => ["class" => "d-none"],
                "required" => true,
                "attr" => [
                    "placeholder" => "Réference",
                    "required" => "required",
                    "onchange " => "handleChange(product_reference)"
                ]
            ])
            ->add('name', TextType::class, [
                "label" => "",
                "label_attr" => ["class" => "d-none"],
                "required" => true,
                "attr" => [
                    "placeholder" => "Nom du produit",
                    "required" => "required",
                    "onchange " => "handleChange(product_name)"
                ]
            ])
            ->add('description', TextareaType::class, [
                "label" => "Description du produit",
                "required" => true,
                "attr" => [
                    "required" => "required"
                ]
            ])
            ->add('lenght', NumberType::class, [
                "label" => "Longueur du produit",
                "required" => false,
                "attr" => [
                    "onchange " => "handleChange(product_lenght)"
                ]
            ])
            ->add('width', NumberType::class, [
                "label" => "Largeur du produit",
                "required" => false,
                "attr" => [
                    "onchange " => "handleChange(product_width)"
                ]
            ])
            ->add('height', NumberType::class, [
                "label" => "Hauteur du produit",
                "required" => false,
                "attr" => [
                    "onchange " => "handleChange(product_width)"
                ]
            ])
            ->add('price', MoneyType::class, [
                "label" => "Prix du produit",
                "required" => true,
                "attr" => [
                    "required" => "required",
                    "onchange " => "handleChange(product_price)"
                ]
            ])
            ->add('price_ttc', MoneyType::class, [
                "label" => "Prix du produit TTC",
                "required" => true,
                "attr" => [
                    "required" => "required",
                    "onchange " => "handleChange(product_price_ttc)",
                ]
            ])
            ->add('specificity', TextareaType::class, [
                "label" => "Spécificité du produit",
                "required" => false
            ])
            ->add('meta_description', TextareaType::class, [
                "label" => "Méta description du produit",
                "required" => false
            ])
            ->add('meta_title', TextType::class, [
                "label" => "Méta titre du produit",
                "required" => false,
            ])
            ->add('meta_keyword', TextareaType::class, [
                "label" => "Méta mots clés du produit",
                "required" => false,
            ])
            ->add('is_enabled', CheckboxType::class, [
                "label" => "Produit actif ?",
                "required" => true,
                "attr" => [
                    "required" => "required"
                ]
            ])
            ->add('depth', NumberType::class, [
                "label" => "Profondeur du produit",
                "required" => false,
                "attr" => [
                    "onchange " => "handleChange(product_depth)"
                ]
            ])
            ->add('depth_in', NumberType::class, [
                "label" => "Profondeur intérieur du produit",
                "required" => false,
                "attr" => [
                    "onchange " => "handleChange(product_depth_in)"
                ]
            ])
            ->add('weight', NumberType::class, [
                "label" => "Poids du produit",
                "required" => false,
                "attr" => [
                    "onchange " => "handleChange(product_weight)"
                ]
            ])
            ->add('upc', TextType::class, [
                "label" => "",
                "label_attr" => ["class" => "d-none"],
                "attr" => [
                    "placeholder" => "Code universelle du produit"
                ],
                "required" => false
            ])
            ->add('countryOfOrigin', TextType::class, [
                "label" => "Pays d'origine du produit",
                "required" => false
            ])
            ->add('retail_price', MoneyType::class, [
                "label" => "Prix au detail",
                "required" => false
            ])
            ->add('is_in_stock', IntegerType::class, [
                "label" => "En stock",
                "required" => false
            ])
            ->add('is_on_sale', CheckboxType::class, [
                "label" => "En promotion ?",
                "required" => false
            ])
            ->add('type', EntityType::class, [
                "class" => \App\Entity\ProductType::class,
                "choice_label" => "name",
                "label" => "Type de produit",
                "required" => true,
                "attr" => [
                    "onchange " => "handleChange(product_weight)",
                    "required" => "required"
                ],
                "multiple" => false
            ])
            ->add('provider', EntityType::class, [
                "class" => Provider::class,
                "choice_label" => "name",
                "label" => "Fournisseur du produit",
                "required" => true,
                "attr" => [
                    "required" => "required"
                ],
                "multiple" => false
            ])
            ->add('pictures', CollectionType::class, [
                "entry_type" => PictureType::class,
                "entry_options" => [
                    "label" => false
                ],
                "required" => false,
                "label_attr" => ["class" => "d-none"],
                "allow_add" => true,
                "allow_delete" => true,
                "by_reference" => false
            ])
            ->add('attachment', CollectionType::class, [
                "entry_type" => AttachmentType::class,
                "entry_options" => [
                    "label" => false
                ],
                "required" => false,
                "label_attr" => ["class" => "d-none"],
                "allow_add" => true,
                "allow_delete" => true,
                "by_reference" => false
            ])
            ->add('categories', SearchableEntityType::class, [
                "class" => Category::class,
                'search' => $this->urlGenerator->generate("products"),
                "label_property" => "name",
                "value_property" => "id"
            ])
            ->add('vehicles', SearchableEntityType::class, [
                "class" => Vehicle::class,
                'search' => $this->urlGenerator->generate("vehicles"),
                "label_property" => "declination",
                "value_property" => "id",
                "label_attr" => ["class" => "d-none"],
                "required" => false
            ])
            ->add("submit", SubmitType::class, [
                "label" => "Sauvegarder"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
