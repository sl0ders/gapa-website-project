<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\Public\SearchType;
use App\Repository\ProductRepository;
use App\Repository\ProductTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request, ProductRepository $productRepository, ProductTypeRepository $productTypeRepository): Response
    {
        $productTypes = $productTypeRepository->findAll();
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
        return $this->render('index.html.twig', [
            "productTypes" => $productTypes,
            "products" => $products,
            'form' => $form->createView()
        ]);
    }
}
