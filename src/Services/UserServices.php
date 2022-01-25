<?php

namespace App\Services;

use App\Entity\User;
use App\Repository\UserRepository;
use Cocur\Slugify\SlugifyInterface;
use Doctrine\ORM\EntityManagerInterface;

class UserServices
{
    private EntityManagerInterface $entityManager;
    private UserRepository $userRepository;
    private SlugifyInterface $slugify;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager, UserRepository $userRepository, SlugifyInterface $slugify)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
        $this->slugify = $slugify;
    }

    public function addRoles()
    {
        $users = $this->entityManager->getRepository(User::class)->findAll();
        foreach ($users as $user) {
                $user->setRoles(["ROLE_USER"]);
                $this->entityManager->persist($user);
        }
        $this->entityManager->flush();
        return "ok";
    }

    /**
     * @return void
     * Add the productSlug
     */
    public function addSlug()
    {
        $users = $this->userRepository->findAll();
        foreach ($users as $user) {
            $user->setSlug($this->slugify->slugify($user->getFullname()));
            $this->entityManager->persist($user);
        }
        $this->entityManager->flush();
    }
}