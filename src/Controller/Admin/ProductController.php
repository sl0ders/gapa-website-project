<?php

namespace App\Controller\Admin;

use App\Entity\Picture;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
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
    public function index(ProductRepository $productRepository, ProductServices $productServices): Response
    {
        $productServices->addFrontRunner();

        return $this->render('admin/product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_product_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On recupere les images transmises

            $pictures = $form->get('pictures')->getData();
            dd($pictures);
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
    public function edit(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les images transmises
            $pictures = $form->get('pictures')->getData();
            $files = $form->get('attachment')->getData();
            foreach ($files as $file) {
                if ($file->getAttachmentFile()) {
                    $newFile = $file->getAttachmentFile();
                    $fichier = md5(uniqid('', true)) . "." . $newFile->guessExtension();
                    $newFile->move(
                        $this->getParameter("files_directory"),
                        $fichier
                    );
                    $fichierFinal = $this->getParameter("files_directory") . "/" . $fichier;
                    $file->setName("../upload/files/" . $fichier);
                    $file->setDescription($file->getDescription());
                    $file->setFormat(pathinfo($fichierFinal)["extension"]);
                    $product->addAttachment($file);
                }
            }
            foreach ($pictures as $picture) {
                if ($picture->getImageFile()) {
                    $newPicture = $picture->getImageFile();
                    $fichier = md5(uniqid('', true)) . "." . $newPicture->guessExtension();
                    $newPicture->move(
                        $this->getParameter("pictures_directory"),
                        $fichier
                    );
                    $fichierFinal = $this->getParameter("pictures_directory") . "/" . $fichier;
                    $width = (getimagesize($this->getParameter("pictures_directory") . "/" . $fichier)[0]);
                    $height = (getimagesize($this->getParameter("pictures_directory") . "/" . $fichier)[1]);
                    $picture->setName("../upload/images/" . $fichier);
                    $picture->setFormat(getimagesize($fichierFinal)["mime"]);
                    $picture->setWidth($width);
                    $picture->setHeight($height);
                    $product->addPicture($picture);
                }
            }
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
