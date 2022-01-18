<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Entity\VehicleDeclination;
use App\Form\ProductType;
use App\Repository\ModelVersionRepository;
use App\Repository\ProductRepository;
use App\Repository\VehicleMarkRepository;
use App\Repository\VehicleModelRepository;
use App\Repository\VehicleRangeRepository;
use App\Services\ProductServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/product')]
class ProductController extends AbstractController
{
    /**
     * @throws \JsonException
     */
    #[Route('/', name: 'admin_product_index', methods: ['GET'])]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('admin/product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_product_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProductServices $productServices, EntityManagerInterface $entityManager, VehicleMarkRepository $markRepository, VehicleRangeRepository $rangeRepository, VehicleModelRepository $modelRepository, ModelVersionRepository $versionRepository): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**  Traitement des declinaison de vehicule et affiliation au marque, model version... */
            $declinations = $form->getData()->getVehicleDeclinations();
            $product = $productServices->addDeclinations($declinations, $product);
            $pictures = $form->get('pictures')->getData();
            $files = $form->get('attachment')->getData();
            $productServices->addFile($files, $pictures, $product);
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('admin_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/product/new.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_product_show', methods: ['GET'])]
    public function show(Product $product): Response
    {
        return $this->render('admin/product/show.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_product_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product, EntityManagerInterface $entityManager, ProductServices $productServices): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les images transmises
            $pictures = $form->get('pictures')->getData();
            $files = $form->get('attachment')->getData();
            $product = $productServices->addFile($files, $pictures, $product);
            $entityManager->persist($product);
            $entityManager->flush();
            $this->addFlash("success", "Le produit a bien été modifié");
            return $this->redirectToRoute('admin_product_index');
        }

        return $this->renderForm('admin/product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_product_delete', methods: ['POST'])]
    public function delete(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->request->get('_token'))) {
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_product_index', [], Response::HTTP_SEE_OTHER);
    }
}
