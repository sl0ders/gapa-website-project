<?php

namespace App\Services;

use App\Repository\CategoryRepository;
use Cocur\Slugify\SlugifyInterface;
use Doctrine\ORM\EntityManagerInterface;

class CategoryServices
{
    private SlugifyInterface $slugify;
    private CategoryRepository $categoryRepository;
    private EntityManagerInterface $entityManager;

    /**
     * @param SlugifyInterface $slugify
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(SlugifyInterface $slugify, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager)
    {
        $this->slugify = $slugify;
        $this->categoryRepository = $categoryRepository;
        $this->entityManager = $entityManager;
    }
}