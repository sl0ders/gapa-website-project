<?php

namespace App\Services;

use App\Repository\CategoryRepository;
use App\Repository\ProviderRepository;
use Doctrine\ORM\EntityManagerInterface;

class ProviderService
{
    private CategoryRepository $categoryRepository;
    private ProviderRepository $providerRepository;
    private EntityManagerInterface $entityManager;

    /**
     * @param CategoryRepository $categoryRepository
     * @param ProviderRepository $providerRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(CategoryRepository $categoryRepository, ProviderRepository $providerRepository, EntityManagerInterface $entityManager)
    {
        $this->categoryRepository = $categoryRepository;
        $this->providerRepository = $providerRepository;
        $this->entityManager = $entityManager;
    }
}