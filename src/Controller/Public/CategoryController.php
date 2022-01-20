<?php

namespace App\Controller\Public;

use App\Data\SearchData;
use App\Entity\Category;
use App\Form\Public\SearchType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/category")]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'public_category_index')]
    public function index(): Response
    {
        return $this->render('public/category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    #[Route("/show/{slug}", name: "public_category_show")]
    public function showProduct(Category $category, Request $request, PaginatorInterface $paginator): Response
    {
        $data = new SearchData();
        $data->page = $request->get("page", 1);
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);
        $query = $category->getProducts();
        $products = $paginator->paginate(
            $query,
            1,
            15
        );
        if ($request->get("ajax")) {
            return new JsonResponse([
                'content' => $this->renderView("public/product/_products.html.twig", ["products" => $products]),
                'sorting' => $this->renderView("public/product/_sorting.html.twig", ["products" => $products]),
                'pagination' => $this->renderView("public/product/_pagination.html.twig", ["products" => $products]),
                "pages" => ceil($products->getTotalItemCount() / $products->getItemNumberPerPage())
            ]);
        }
        return $this->render("public/category/show.html.twig", [
            "products" => $products,
            "form" => $form->createView(),
            "category" => $category
        ]);
    }
}
