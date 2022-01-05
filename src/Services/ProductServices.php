<?php

namespace App\Services;

use App\Entity\Address;
use App\Entity\Category;
use App\Entity\Picture;
use App\Entity\Product;
use App\Entity\ProductType;
use App\Entity\Provider;
use App\Repository\CategoryRepository;
use App\Repository\PictureRepository;
use App\Repository\ProductRepository;
use App\Repository\ProductTypeRepository;
use App\Repository\ProviderRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Error;
use JsonException;

class ProductServices
{
    private ProviderRepository $providerRepository;
    private EntityManagerInterface $entityManager;
    private CategoryRepository $categoryRepository;
    private ProductTypeRepository $productTypeRepository;
    private PictureRepository $pictureRepository;
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository, PictureRepository $pictureRepository, ProviderRepository $providerRepository, CategoryRepository $categoryRepository, ProductTypeRepository $productTypeRepository, EntityManagerInterface $entityManager)
    {
        $this->providerRepository = $providerRepository;
        $this->entityManager = $entityManager;
        $this->categoryRepository = $categoryRepository;
        $this->productTypeRepository = $productTypeRepository;
        $this->pictureRepository = $pictureRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @throws JsonException
     */
    public function addFrontRunner()
    {
        $prods = [];
        $json = file_get_contents("https://api.frontrunner.co.za/customer/Pricelist/file/EUR/?account=DGAP801&ApiKey=95f48a4024e54b5194c1c70c4660755e&format=json&language=FR&nonStandardColumns=Dimensions&nonStandardColumns=Categories&nonStandardColumns=Bom&nonStandardColumns=Narrative&nonStandardColumns=Images&nonStandardColumns=FittingInstructions");
        $parsed_json = json_decode($json, false, 512, JSON_THROW_ON_ERROR);
        $productType = $this->productTypeRepository->findOneBy(["name" => "Pièces détachés"]);
        if (!isset($productType)) {
            $productType = new ProductType();
            $productType->setName("Pièces détachés");
            $this->entityManager->persist($productType);
            $this->entityManager->flush();
        }
        $provider = $this->providerRepository->findOneBy(["name" => "Front runner"]);
        if (!$provider instanceof Provider) {
            $fr_address = new Address();
            $fr_address->setAddress1("Zu den Mergelbrüchen 430559 HannoverGermany")
                ->setPostCode("30559")
                ->setIsEnabled(true)
                ->setPhone("+49 (0) 511 47 40 46-400")
                ->setCreatedAt(new DateTime());
            $this->entityManager->persist($fr_address);
            $this->entityManager->flush();
            $provider = new Provider();
            $provider->setName("Front runner");
            $provider->setPhone("+49 (0) 511 47 40 46-400");
            $provider->setEmail("FrontRunner@gmail.com");
            $provider->setAddress($fr_address);
            $this->entityManager->persist($provider);
            $this->entityManager->flush();
        }
        foreach ($parsed_json as $article) {
            $chaine = $article->{"Categories"};
            $categoriesJson = explode("|", $chaine);
            $position = 0;

            $product = $this->productRepository->findOneBy(["reference" => $article->{"Code"}]);
            if (!isset($product)) {
                $product = new Product();
                $product
                    ->setAddAt(new DateTime())
                    ->setProvider($provider)
                    ->setName($article->{"Description"})
                    ->setReference($article->{"Code"})
                    ->setLenght($article->{"Length_mm"})
                    ->setWidth($article->{"Width_mm"})
                    ->setWeight($article->{"Weight_kg"})
                    ->setRetailPrice($article->{"RetailPrice"})
                    ->setTariffcode($article->{"Tariffcode"})
                    ->setMetaDescription($article->{"Narration"})
                    ->setMetaKeyword($article->{"Categories"})
                    ->setMetaTitle($article->{"Description"})
                    ->setSpecificity($article->{"Specification"})
                    ->setDescription($article->{"Narration"})
                    ->setCountryOfOrigin($article->{"CountryOfOrigin"})
                    ->setUpc($article->{"UPC"})
                    ->setPrice(0.00)
                    ->setPriceTtc(0.00)
                    ->setCurrency($article->{"Currency"})
                    ->setDepthIn($article->{"Depth_in"})
                    ->setIsEnabled(true)
                    ->setType($productType)
                    ->setPosition($position);
                if (isset($article->{"Image_1"})) {
                    $picture = $this->getPictures($article->{"Image_1"});
                    $product->addPicture($picture);
                }
                if (isset($article->{"Image_2"})) {
                    $picture = $this->getPictures($article->{"Image_2"});
                    $product->addPicture($picture);
                }
                if (isset($article->{"Image_3"})) {
                    $picture = $this->getPictures($article->{"Image_3"});
                    $product->addPicture($picture);
                }
                if (isset($article->{"Image_4"})) {
                    $picture = $this->getPictures($article->{"Image_4"});
                    $product->addPicture($picture);
                }
                if (isset($article->{"Image_5"})) {
                    $picture = $this->getPictures($article->{"Image_5"});
                    $product->addPicture($picture);
                }
                if (isset($article->{"Image_6"})) {
                    $picture = $this->getPictures($article->{"Image_6"});
                    $product->addPicture($picture);
                }
                if (isset($article->{"Image_7"})) {
                    $picture = $this->getPictures($article->{"Image_7"});
                    $product->addPicture($picture);
                }
                if (isset($article->{"Image_8"})) {
                    $picture = $this->getPictures($article->{"Image_8"});
                    $product->addPicture($picture);
                }
                foreach ($categoriesJson as $catName) {
                    $category = $this->categoryRepository->findOneBy(["name" => $catName]);
                    if (!isset($category)) {
                        $category = new Category();
                        $category->setName($catName);
                        $category->setPosition($position);
                        $this->entityManager->persist($category);
                        $this->entityManager->flush();
                        $product->addCategory($category);
                    }
                    $position++;
                }
            }
            $prods[] = $product;
        }
        return $prods;
    }

    public function getPictures($pictureName)
    {
        $picture = new Picture();
        $picture->setName($pictureName);
        $pictureWidth = getimagesize($pictureName)[0];
        $pictureHeight = getimagesize($pictureName)[2];
        $pictureMimeType = getimagesize($pictureName)["mime"];
        $pictureSize = getimagesize($pictureName)["bits"];

        $picture->setWidth($pictureWidth);
        $picture->setHeight($pictureHeight);
        $picture->setFormat($pictureMimeType);
        $picture->setSize($pictureSize);
        $this->entityManager->persist($picture);
        $this->entityManager->flush();
        return $picture;
    }
}