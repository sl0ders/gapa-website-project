<?php

namespace App\Services;

use App\Entity\Address;
use App\Entity\Attachment;
use App\Entity\Category;
use App\Entity\File;
use App\Entity\Picture;
use App\Entity\Product;
use App\Entity\ProductType;
use App\Entity\Provider;
use App\Kernel;
use App\Repository\CategoryRepository;
use App\Repository\PictureRepository;
use App\Repository\ProductRepository;
use App\Repository\ProductTypeRepository;
use App\Repository\ProviderRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Error;
use JsonException;
use Monolog\Handler\IFTTTHandler;

class ProductServices
{
    private ProviderRepository $providerRepository;
    private EntityManagerInterface $entityManager;
    private CategoryRepository $categoryRepository;
    private ProductTypeRepository $productTypeRepository;
    private PictureRepository $pictureRepository;
    private ProductRepository $productRepository;
    private string $targetDirectory;

    public function __construct(string $targetDirectory, ProductRepository $productRepository, PictureRepository $pictureRepository, ProviderRepository $providerRepository, CategoryRepository $categoryRepository, ProductTypeRepository $productTypeRepository, EntityManagerInterface $entityManager)
    {
        $this->providerRepository = $providerRepository;
        $this->entityManager = $entityManager;
        $this->categoryRepository = $categoryRepository;
        $this->productTypeRepository = $productTypeRepository;
        $this->pictureRepository = $pictureRepository;
        $this->productRepository = $productRepository;
        $this->targetDirectory = $targetDirectory;
    }

    /**
     * @throws JsonException
     */
    public function addFrontRunner()
    {
        ini_set('max_execution_time', 0);
        /**
         * @var ProductType $productType
         * I test if the productType with name "Pièce detaché" exist
         */
        $productType = $this->productTypeRepository->findOneBy(["name" => "Pièces détachés"]);
        /** if not exist i create a ProductType for Front Runner product */
        if (!isset($productType)) {
            $productType = new ProductType();
            $productType->setName("Pièces détachés");
            $this->entityManager->persist($productType);
            $this->entityManager->flush();
        }

        /**
         * @var Provider $provider
         * Test if an provider with name "front runner" exist
         */
        $provider = $this->providerRepository->findOneBy(["name" => "Front runner"]);

        /** If not exist i create this Provider */
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
            $provider->setUrl("https://www.frontrunneroutfitters.com/fr/be/");
            $provider->setAddress($fr_address);
            $this->entityManager->persist($provider);
            $this->entityManager->flush();
        }

        /**
         * @var string $json
         *  this variable result of api file of front runner
         */
        $apiFrontRunnerJson = file_get_contents($this->targetDirectory . "/productFrontRunner.json");
        $parsed_json = json_decode($apiFrontRunnerJson, false, 512, JSON_THROW_ON_ERROR);

        /** @var product $article */
        foreach ($parsed_json as $article) {
//            /** Each product of this json list have many category spacing by "|", i'm explode this line for retreave each category */
//            $chaine = $article->{"Categories"};
//            $categoriesJson = explode("|", $chaine);
//            $position = 0;
            $product = $this->productRepository->findOneBy(["reference" => $article->{"Code"}]);
//            if (!isset($product)) {
//                /** if not exist i create a new produit for this while */
//                $product = new Product();
//                $product
//                    ->setAddAt(new DateTime())
//                    ->setProvider($provider)
//                    ->setName($article->{"Description"})
//                    ->setReference($article->{"Code"})
//                    ->setLenght($article->{"Length_mm"})
//                    ->setWidth($article->{"Width_mm"})
//                    ->setWeight($article->{"Weight_kg"})
//                    ->setRetailPrice($article->{"RetailPrice"})
//                    ->setTariffcode($article->{"Tariffcode"})
//                    ->setMetaDescription($article->{"Narration"})
//                    ->setMetaKeyword($article->{"Categories"})
//                    ->setMetaTitle($article->{"Description"})
//                    ->setSpecificity($article->{"Specification"})
//                    ->setDescription($article->{"Narration"})
//                    ->setCountryOfOrigin($article->{"CountryOfOrigin"})
//                    ->setUpc($article->{"UPC"})
//                    ->setPrice(0.00)
//                    ->setPriceTtc(0.00)
//                    ->setCurrency($article->{"Currency"})
//                    ->setDepthIn($article->{"Depth_in"})
//                    ->setIsEnabled(true)
//                    ->setType($productType)
//                    ->setPosition($position);
            if (isset($article->{"FittingInstruction_1"})) {
                $file = $this->getFiles($article->{"FittingInstruction_1"});
                $product->addAttachment($file);
            }
            if (isset($article->{"FittingInstruction_2"})) {
                $file = $this->getFiles($article->{"FittingInstruction_2"});
                $product->addAttachment($file);
            }
            if (isset($article->{"FittingInstruction_3"})) {
                $file = $this->getFiles($article->{"FittingInstruction_3"});
                $product->addAttachment($file);
            }
            if (isset($article->{"FittingInstruction_4"})) {
                $file = $this->getFiles($article->{"FittingInstruction_4"});
                $product->addAttachment($file);
            }
            if (isset($article->{"FittingInstruction_5"})) {
                $file = $this->getFiles($article->{"FittingInstruction_5"});
                $product->addAttachment($file);
            }
            $this->entityManager->persist($product);
            $this->entityManager->flush();
        }
    }
//                if (isset($article->{"Image_1"})) {
//                    $picture = $this->getPictures($article->{"Image_1"});
//                    $product->addPicture($picture);
//                }
//                if (isset($article->{"Image_2"})) {
//                    $picture = $this->getPictures($article->{"Image_2"});
//                    $product->addPicture($picture);
//                }
//                if (isset($article->{"Image_3"})) {
//                    $picture = $this->getPictures($article->{"Image_3"});
//                    $product->addPicture($picture);
//                }
//                if (isset($article->{"Image_4"})) {
//                    $picture = $this->getPictures($article->{"Image_4"});
//                    $product->addPicture($picture);
//                }
//                if (isset($article->{"Image_5"})) {
//                    $picture = $this->getPictures($article->{"Image_5"});
//                    $product->addPicture($picture);
//                }
//                if (isset($article->{"Image_6"})) {
//                    $picture = $this->getPictures($article->{"Image_6"});
//                    $product->addPicture($picture);
//                }
//                if (isset($article->{"Image_7"})) {
//                    $picture = $this->getPictures($article->{"Image_7"});
//                    $product->addPicture($picture);
//                }
//                if (isset($article->{"Image_8"})) {
//                    $picture = $this->getPictures($article->{"Image_8"});
//                    $product->addPicture($picture);
//                }
//                foreach ($categoriesJson as $catName) {
//                    $category = $this->categoryRepository->findOneBy(["name" => $catName]);
//                    if (!isset($category)) {
//                        $category = new Category();
//                        $category->setName($catName);
//                        $category->setPosition($position);
//                        $provider->addCategory($category);
//                        $this->entityManager->persist($category);
//                        $this->entityManager->persist($provider);
//                        $this->entityManager->flush();
//                    }
//                    $category->addProduct($product);
//                    $position++;
//                }
//                $this->entityManager->persist($product);
//                $this->entityManager->flush();
//            }
//        }
//    }

    private function getPictures($pictureName): Picture
    {
        $picture = new Picture();
        $picture->setName($pictureName);
        $pictureWidth = getimagesize($pictureName)[0];
        $pictureHeight = getimagesize($pictureName)[1];
        $pictureMimeType = getimagesize($pictureName)["mime"];
        $picture->setWidth($pictureWidth);
        $picture->setHeight($pictureHeight);
        $picture->setFormat($pictureMimeType);
        $this->entityManager->persist($picture);
        $this->entityManager->flush();
        return $picture;
    }

    /**
     * @return void
     * This function retrieve en associate the api price of front runner for each product
     * @throws JsonException
     */
    public function updatePrice()
    {
        $apiFrontRunnerJson = file_get_contents($this->targetDirectory . "/priceList.json");

        /** @var string $apiFrontRunnerJson */
        $priceProducts = json_decode($apiFrontRunnerJson, false, 512, JSON_THROW_ON_ERROR);

        foreach ($priceProducts as $priceProduct) {
            /** @var Product $product */
            $product = $this->productRepository->findOneBy(["reference" => $priceProduct->{"lineCode"}]);
            if (isset($product)) {
                $product->setPrice($priceProduct->{"coreCost"});
                $product->setPriceTtc($priceProduct->{"coreCost"} * 1.2);
                $product->setIsInStock($priceProduct->{"totalOnHand"});
                $this->entityManager->persist($product);
                $this->entityManager->flush();
            } else {
                continue;
            }
        }
    }

    private function getFiles($param): Attachment
    {
        $file = new Attachment();
        $file->setName($param)
            ->setFormat("pdf");
        $this->entityManager->persist($file);
        $this->entityManager->flush();
        return $file;
    }
}