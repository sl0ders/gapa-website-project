<?php

namespace App\Services;

use App\Entity\ModelVersion;
use App\Entity\Vehicle;
use App\Entity\VehicleMark;
use App\Entity\VehicleModel;
use App\Entity\VersionYears;
use App\Repository\ModelVersionRepository;
use App\Repository\VehicleMarkRepository;
use App\Repository\VehicleModelRepository;
use App\Repository\VehicleRepository;
use App\Repository\VersionYearsRepository;
use Doctrine\ORM\EntityManagerInterface;

class MarkServices
{

    private EntityManagerInterface $entityManager;
    private ModelVersionRepository $versionRepository;
    private VehicleRepository $vehicleRepository;
    private VehicleMarkRepository $markRepository;
    private VehicleModelRepository $modelRepository;
    private VersionYearsRepository $versionYearsRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        ModelVersionRepository $versionRepository,
        VehicleRepository      $vehicleRepository,
        VehicleMarkRepository  $markRepository,
        VehicleModelRepository $modelRepository,
        VersionYearsRepository $versionYearsRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->versionRepository = $versionRepository;
        $this->vehicleRepository = $vehicleRepository;
        $this->markRepository = $markRepository;
        $this->modelRepository = $modelRepository;
        $this->versionYearsRepository = $versionYearsRepository;
    }

    public function addNewMark()
    {
        ini_set('max_execution_time', 0);
        $vehicles = $this->vehicleRepository->findAll();
        foreach ($vehicles as $vehicle) {
            $mark = $this->markRepository->findOneBy(["name" => $vehicle->getMarque()]);
            if (!isset($mark)) {
                $mark = new VehicleMark();
                $mark->setName($vehicle->getMarque());
                $this->entityManager->persist($mark);
                $this->entityManager->flush();
            }
            $model = $this->modelRepository->findOneBy(["name" => $vehicle->getModele(), "vehicleMark" => $mark]);
            if (!isset($model)) {
                $model = new VehicleModel();
                $model->setName($vehicle->getModele());
                $model->setVehicleMark($mark);
                $this->entityManager->persist($model);
                $this->entityManager->flush();
            }
            $versionYears = $this->versionYearsRepository->findOneBy(["name" => $vehicle->getAnnees()]);
            if (!isset($versionYears)) {
                $versionYears = new VersionYears();
                $versionYears->setName($vehicle->getAnnees());
                $this->entityManager->persist($versionYears);
                $this->entityManager->flush();
            }
            $version = $this->versionRepository->findOneBy(["name" => $vehicle->getVersion(), "model" => $model, "versionYears" => $versionYears, "vehicleMark" => $mark]);
            if (!isset($version)) {
                $version = new ModelVersion();
                $version->setName($vehicle->getVersion());
                $version->setVehicleMark($mark);
                $version->setModel($model);
                $version->setVersionYears($versionYears);
                $version->setMotorisation($vehicle->getMoteur());
                $version->setType($vehicle->getType());
                $this->entityManager->persist($version);
                $this->entityManager->flush();
            }
        }
    }

    public function SyncMark()
    {
        ini_set('max_execution_time', 0);
        $vehicles = $this->vehicleRepository->findAll();
        foreach ($vehicles as $vehicle) {
            $vehicle->setDeclination(
                $vehicle->getMarque() . " / " . $vehicle->getModele() . " / " . $vehicle->getVersion() . " / " . $vehicle->getAnnees() . " / " . $vehicle->getMoteur() . " / " . $vehicle->getType());
            $this->entityManager->persist($vehicle);
        }
        $this->entityManager->flush();
    }
}