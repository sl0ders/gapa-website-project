<?php

namespace App\Form\Public;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('address1', TextType::class, [
                "label" => "Adresse principale",
            ])
            ->add('address2', TextType::class, [
                "label" => "Adresse secondaire",
                "required" => false
            ])
            ->add('post_code', IntegerType::class, [
                "label" => "Code postal"
            ])
            ->add('phone', TelType::class, [
                "label" => "Numero de telephone fixe",
                "required" => false
            ])
            ->add('phone_mobile', TelType::class, [
                "label" => "Numero de telephone portable",
                "required" => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
