<?php

namespace App\Form\Public;

use App\Entity\ModelVersion;
use App\Entity\Product;
use App\Entity\VehicleMark;
use App\Entity\VehicleModel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mark', EntityType::class, [
                "class" => VehicleMark::class,
                "label_attr" => ["class" => "d-none"],
                "attr" => ["placeholder" => "Marques"],
                "choice_label" => "name",
                "mapped" => false
            ])
            ->add('vehicleModel', EntityType::class, [
                "class" => VehicleModel::class,
                "label_attr" => ["class" => "d-none"],
                "attr" => ["placeholder" => "Modèles"],
                "choice_label" => "name",
                "mapped" => false
            ])
            ->add('modelVersion', EntityType::class, [
                "class" => ModelVersion::class,
                "label_attr" => ["class" => "d-none"],
                "attr" => ["placeholder" => "Version"],
                "choice_label" => "name",
                "mapped" => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
