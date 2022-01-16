<?php

namespace App\Controller\Public;

use App\Data\SearchData;
use App\Form\SearchType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/product')]
class ProductController extends AbstractController
{
    #[Route("/", name: "public_product_index")]
    public function index(ProductRepository $productRepository, Request $request): Response
    {
        $data = new SearchData();
        $data->page = $request->get("page", 1);
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);
        $products = $productRepository->findSearch($data);
        return $this->render("public/product/index.html.twig", [
            "products" => $products,
            "form" => $form->createView()
        ]);
    }



//    /**
//     * @throws JsonException
//     */
//    #[Route('/sync', name: 'public_product_sync')]
//    public function sync(ProductServices $productServices): Response
//    {
//        $productServices->addFrontRunner();
//        return $this->redirectToRoute("public_product_index");
//    }
//
//
//    #[Route('/sync-price', name: 'public_product_sync_price')]
//    public function syncPrice(ProductServices $productServices): Response
//    {
//        $productServices->updatePrice();
//        return $this->redirectToRoute("public_product_index");
//    }
}
