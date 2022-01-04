<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\AttributeGroupRepository;
use App\Repository\CategoryRepository;
use App\Repository\VehicleMarkRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
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

    public function publicLayoutHeader(VehicleMarkRepository $markRepository): Response
    {
        return $this->render("layout/_header.html.twig", [
            "marks" => $markRepository->findBy([], ["name" => "DESC"])
        ]);
    }
}