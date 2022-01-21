<?php

namespace App\Controller;

use App\Entity\Vehicle;
use App\Repository\CategoryRepository;
use App\Repository\ModelVersionRepository;
use App\Repository\ProviderRepository;
use App\Repository\VehicleMarkRepository;
use App\Repository\VehicleModelRepository;
use App\Repository\VehicleRepository;
use App\Repository\VersionYearsRepository;
use Doctrine\ORM\EntityManagerInterface;
use JsonException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/getAttributeByGroup', name: "getAttributeByGroup")]
    public function getAttributeByGroup(Request $request, AttributeRepository $attributeRepository): Response
    {

        $groupId = $request->get("group");
        $attributes = $attributeRepository->findBy(["attributeGroup" => $groupId]);

        foreach ($attributes as $attribute) {
            $attributeArray[$attribute->getId()] = $attribute->getAttributeText()->getName();
        }
        $response = new Response(json_encode($attributeArray, JSON_THROW_ON_ERROR));
        $response->headers->set("Content-Type", "application/json");
        return $response;
    }

    /**
     * @throws JsonException
     */
    #[Route('/addGroupAttValue', name: "addGroupAttValue")]
    public function addGroupAttValue(Request $request, AttributeRepository $attributeRepository, AttributeGroupRepository $attributeGroupRepository, EntityManagerInterface $entityManager): Response
    {
        foreach ($request->get("attValueList") as $groupAttr) {
            $group = $attributeGroupRepository->find($groupAttr[0][0]);
            $attribute = $attributeRepository->find($groupAttr[0][1]);
            $declinationGroupAttr = new DeclinationGroupAttribute();
            $declinationGroupAttr->setAttribute($attribute);
            $declinationGroupAttr->setAttributeGroup($group);
            $declinationGroupAttr->setReference($groupAttr[1]);
            $entityManager->persist($declinationGroupAttr);
        }
        $entityManager->flush();
        $response = new Response(json_encode(["ok"], JSON_THROW_ON_ERROR));
        $response->headers->set("Content-Type", "application/json");
        return $response;
    }

    /**
     * @throws JsonException
     */
    #[Route("/getVersionYear", name: "getVersionYear")]
    public function getVersionYear(Request $request, VersionYearsRepository $versionYearsRepository, VehicleMarkRepository $markRepository): Response
    {
        $versionYearsArray = [];
        $markId = $request->request->get("mark");
        $mark = $markRepository->find($markId);
        $versionYears = $versionYearsRepository->getVersionYearsByMark($mark);
        /** @var Vehicle $vehicle */
        foreach ($versionYears as $versionYear) {
            $versionYearsArray[$versionYear->getId()] = $versionYear->getName();
        }
        $response = new Response(json_encode($versionYearsArray, JSON_THROW_ON_ERROR));
        $response->headers->set("Content-Type", "application/json");
        return $response;
    }

    /**
     * @throws JsonException
     */
    #[Route("/getModels", name: "getModels")]
    public function getModels(Request $request, VehicleModelRepository $modelRepository): Response
    {
        $modelsArray = [];
        $versionYear = $request->request->get("versionYears");
        $models = $modelRepository->getModelsByVersionYear($versionYear);
        foreach ($models as $model) {
            $modelsArray[$model->getId()] = $model->getName();
        }
        $response = new Response(json_encode($modelsArray, JSON_THROW_ON_ERROR));
        $response->headers->set("Content-Type", "application/json");
        return $response;
    }

    /**
     * @throws JsonException
     */
    #[Route("/getCategoriesParent", name: "getCategoriesParents")]
    public function getCategoriesParent(Request $request, ProviderRepository $providerRepository): Response
    {
        $parentCategoriesArray = [];
        $providerId = $request->get('provider');
        $provider = $providerRepository->find($providerId);
        foreach ($provider->getCategories() as $categoryParent) {
            if ($categoryParent->getIsParentCategory()){
                $parentCategoriesArray[$categoryParent->getId()] = $categoryParent->getName();
            }
        }
        $response = new Response(json_encode($parentCategoriesArray, JSON_THROW_ON_ERROR));
        $response->headers->set("Content-Type", "application/json");
        return $response;
    }

    /**
     * @throws JsonException
     */
    #[Route("/getCategories", name: "getCategories")]
    public function getCategories(Request $request, ProviderRepository $providerRepository)
    {
        $data = [];
        $providerId = $request->get("provider");
        $provider = $providerRepository->find($providerId);
        $categories = $provider->getCategories();
        if (count($categories) > 0) {
            foreach ($categories as $category) {
                $data[$category->getId()] = $category->getName();
            }
        } else {
            $data = [];
        }

        $response = new Response(json_encode($data, JSON_THROW_ON_ERROR));
        $response->headers->set("Content-Type", "application/json");
        return $response;
    }


    /**
     * @throws JsonException
     */
    #[
        Route("/getVersions", name: "getVersions")]
    public function getVersions(Request $request, ModelVersionRepository $versionRepository): Response
    {
        $versionsArray = [];
        $modelId = $request->request->get("model");
        $versions = $versionRepository->findBy(["model" => $modelId]);
        foreach ($versions as $version) {
            $versionsArray[$version->getId()] = $version->getName();
        }
        $response = new Response(json_encode($versionsArray, JSON_THROW_ON_ERROR));
        $response->headers->set("Content-Type", "application/json");
        return $response;
    }

    #[Route("/api/products", name: "products")]
    public function getProducts(Request $request, CategoryRepository $categoryRepository): JsonResponse
    {
        return $this->json($categoryRepository->search($request->query->get("q")));
    }

    #[Route("/api/vehicles", name: "vehicles")]
    public function getVehicles(Request $request, VehicleRepository $vehicleRepository): JsonResponse
    {
        return $this->json($vehicleRepository->search($request->query->get("q")));
    }

    /**
     * @throws JsonException
     */
    #[Route("/api/getProduct", name: "getProducts")]
    public function getProduct(Request $request, CategoryRepository $categoryRepository)
    {
        $categoryId = $request->request->get("categoryId");
        if ($categoryId) {
            $productArray = [];
            $category = $categoryRepository->find($categoryId);
            $products = $category->getProducts();
            foreach ($products as $product) {
                $productArray[$product->getId()] = $product->getName();
            }
            dd($productArray);
            $response = new Response(json_encode($productArray, JSON_THROW_ON_ERROR));
            $response->headers->set("Content-Type", "application/json");
            return $response;
        }
    }
}