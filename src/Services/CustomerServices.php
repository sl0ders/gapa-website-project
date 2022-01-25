<?php

namespace App\Services;

use App\Repository\CustomerRepository;
use Cocur\Slugify\SlugifyInterface;
use Doctrine\ORM\EntityManagerInterface;

class CustomerServices
{
    private CustomerRepository $customerRepository;
    private EntityManagerInterface $em;
    private SlugifyInterface $slugify;

    public function __construct(EntityManagerInterface $em, CustomerRepository $customerRepository, SlugifyInterface $slugify)
    {
        $this->customerRepository = $customerRepository;
        $this->em = $em;
        $this->slugify = $slugify;
    }

    public function addFullname()
    {
        $customers = $this->customerRepository->findAll();
        foreach ($customers as $customer) {
            $customer->setFullname($customer->getUser()->getFullname());
            $customer->setSlug($this->slugify->slugify($customer->getUser()->getFullname()));
            $this->em->persist($customer);
        }
        $this->em->flush($customers);
    }
}