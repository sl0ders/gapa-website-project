<?php

namespace App\Controller;

use App\Repository\ProviderRepository;
use App\Repository\VehicleMarkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class LayoutBundleController extends AbstractController
{
    public function adminLayoutLeft(): Response
    {
        $uri = $_SERVER["REQUEST_URI"];
        return $this->render("admin/layout/_leftColumnAdmin.html.twig", [
            "uri" => $uri
        ]);
    }

    public function adminLayoutHeader(): Response
    {
        return $this->render("admin/layout/_header.html.twig", [

        ]);
    }

    public function publicLayoutHeader(VehicleMarkRepository $markRepository, ProviderRepository $providerRepository): Response
    {
        $providers = $providerRepository->findAll();
        return $this->render("layout/_header.html.twig", [
            "marks" => $markRepository->findBy([], ["name" => "DESC"]),
            "providers" => $providers
        ]);
    }
}