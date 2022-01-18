<?php

namespace App\Controller;

use App\Entity\Attribute;
use App\Entity\AttributeGroup;
use App\Entity\AttributeText;
use App\Entity\DeclinationGroupAttribute;
use App\Entity\ModelVersion;
use App\Entity\VehicleModel;
use App\Repository\AttributeGroupRepository;
use App\Repository\AttributeRepository;
use App\Repository\CategoryRepository;
use App\Repository\ModelVersionRepository;
use App\Repository\ProductRepository;
use App\Repository\ProviderRepository;
use App\Repository\VehicleDeclinationRepository;
use App\Repository\VehicleModelRepository;
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

    #[Route("/adminAttributeAdd", name: "admin_attribute_add")]
    public function admin_attribute_add(Request $request, EntityManagerInterface $entityManager)
    {
        $attrs = $request->get('attrArray');
        $attributeGroup = new AttributeGroup();
        $attributeGroup->setName($attrs[0][1]);
        $entityManager->persist($attributeGroup);
        $entityManager->flush();
        $data = [];
        foreach ($attrs as $attr) {
            $attribute = new Attribute();
            $attributeText = new AttributeText();
            $attribute->setAttributeText($attributeText);
            $attribute->getAttributeText()->setName($attr[0]);
            $attribute->setAttributeGroup($attributeGroup);
            $entityManager->persist($attribute);
            $entityManager->persist($attributeText);
            $entityManager->flush();
            $data[$attribute->getId()] = $attribute->getAttributeText()->getName();
        }
        $response = new Response(json_encode($data, JSON_THROW_ON_ERROR));
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
        $markId = $request->request->get("mark");
        $models = $modelRepository->findBy(["vehicleMark" => $markId]);
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

    #[Route("/getProducts", name: "getProducts")]
    public function getProducts(Request $request, ProductRepository $productRepository): Response
    {
        $modelsArray = [];
        $markId = $request->request->get("mark");
        $models = $productRepository->findBy(["" => $markId]);
        foreach ($models as $model) {
            $modelsArray[$model->getId()] = $model->getName();
        }
        $response = new Response(json_encode($modelsArray, JSON_THROW_ON_ERROR));
        $response->headers->set("Content-Type", "application/json");
        return $response;
    }

    #[Route("/api/products", name: "products")]
    public function index(Request $request, CategoryRepository $categoryRepository): JsonResponse
    {
        return $this->json($categoryRepository->search($request->query->get("q")));
    }

    #[Route("/api/declinations", name: "declinations")]
    public function getDeclination(Request $request, VehicleDeclinationRepository $declinationRepository): JsonResponse
    {
        return $this->json($declinationRepository->search($request->query->get("q")));
    }
}