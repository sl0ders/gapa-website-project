<?php

namespace App\Controller\Public;

use App\Data\SearchData;
use App\Entity\Category;
use App\Form\SearchType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/public")]
class CategoryController extends AbstractController
{
    #[Route('/category', name: 'public_category_index')]
    public function index(): Response
    {
        return $this->render('public/category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    #[Route("show/{id}", name: "public_category_show")]
    public function showProduct(Category $category, Request $request): Response
    {
        $data = new SearchData();
        $data->page = $request->get("page", 1);
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);
        $products = $category->getProducts();
        return $this->render("public/category/show.html.twig", [
            "products" => $products,
            "form" => $form->createView(),
            "category" => $category
        ]);
    }
}
