<?php

namespace App\Form\Admin;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference')
            ->add('total_price_ht')
            ->add('total_price_ttc')
            ->add('address_delivery')
            ->add('address_invoice')
            ->add('created_at')
            ->add('updated_at')
            ->add('user')
            ->add('orderState')
            ->add('products')
            ->add('orderHistory')
            ->add('orderDetail')
            ->add('customer')
            ->add('delivery')
            ->add('cart')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
