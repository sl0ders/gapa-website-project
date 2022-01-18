<?php

namespace App\Services;

use App\Entity\VehicleDeclination;
use App\Entity\VehicleMark;
use App\Repository\ModelVersionRepository;
use App\Repository\VehicleDeclinationRepository;
use Doctrine\ORM\EntityManagerInterface;

class MarkServices
{

    private EntityManagerInterface $entityManager;
    private ModelVersionRepository $versionRepository;

    public function __construct(EntityManagerInterface $entityManager, ModelVersionRepository $versionRepository)
    {
        $this->entityManager = $entityManager;
        $this->versionRepository = $versionRepository;
    }

    public function SyncMark()
    {
        ini_set('max_execution_time', 0);
        $modelVersions = $this->versionRepository->findAll();
        foreach ($modelVersions as $modelVersion) {
            $declinations = new VehicleDeclination();
            if ($modelVersion->getVehicleRange() !== null) {
                $name = $modelVersion->getMarkName() . "-" . $modelVersion->getModel()->getRangeName() . "-" . $modelVersion->getModelName() . "-". $modelVersion->getYear().  "-" . $modelVersion->getName() . "-" . $modelVersion->getMotorisation() . "-" . $modelVersion->getFrame();
            } else {
                $name = $modelVersion->getMarkName() . "-". "null" . "-". $modelVersion->getModelName() . "-" . $modelVersion->getYear() . "-" . $modelVersion->getName() . "-" . $modelVersion->getMotorisation() . "-" . $modelVersion->getFrame();
            }
            $declinations->setName($name);
            $this->entityManager->persist($declinations);
        }
        $this->entityManager->flush();
    }
}