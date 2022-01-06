<?php

namespace App\Controller\Public;

use App\Repository\ProductRepository;
use App\Services\ProductServices;
use Doctrine\ORM\EntityManagerInterface;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/public/product')]
class ProductController extends AbstractController
{
    #[Route("/", name: "public_product_index")]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render("public/product/index.html.twig", [
        ]);
    }

    /**
     * @throws JsonException
     */
    #[Route('/sync', name: 'public_product_sync')]
    public function sync(ProductServices $productServices): Response
    {
        $productServices->addFrontRunner();
        return $this->redirectToRoute("public_product_index");
    }


    #[Route('/sync-price', name: 'public_product_sync_price')]
    public function syncPrice(ProductServices $productServices): Response
    {
        $productServices->updatePrice();
        return $this->redirectToRoute("public_product_index");
    }
}
