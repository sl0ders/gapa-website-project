<?php

namespace App\Controller\Public;

use App\Entity\Provider;
use App\Repository\CategoryRepository;
use App\Services\ProviderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/provider")]
class ProviderController extends AbstractController
{
    #[Route('/provider', name: 'provider')]
    public function index(): Response
    {
        return $this->render('public/provider/index.html.twig', [
            'controller_name' => 'ProviderController',
        ]);
    }

    #[Route('/{slug}', name: 'public_provider_show', methods: ["GET"])]
    public function show(Provider $provider): Response
    {
        return $this->render('public/provider/index.html.twig', [
            'provider' => $provider,
        ]);
    }
}
