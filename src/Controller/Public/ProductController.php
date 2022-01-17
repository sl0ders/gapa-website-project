<?php

namespace App\Controller\Public;

use App\Data\SearchData;
use App\Form\Public\SearchType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        if ($request->get("ajax")) {
            return new JsonResponse([
                'content' => $this->renderView("public/product/_products.html.twig", ["products" => $products]),
                'sorting' => $this->renderView("public/product/_sorting.html.twig", ["products" => $products]),
                'pagination' => $this->renderView("public/product/_pagination.html.twig", ["products" => $products]),
                "pages" => ceil($products->getTotalItemCount() / $products->getItemNumberPerPage())
            ]);
        }
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
