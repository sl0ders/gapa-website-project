<?php

namespace App\Controller\Admin;

use App\Services\MarkServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/admin/vehicle_mark")]
class VehicleMarkController extends AbstractController
{
    #[Route('/', name: 'admin_vehicle_mark_index')]
    public function index(): Response
    {
        return $this->render('admin/vehicle_mark/index.html.twig', [
            'controller_name' => 'VehicleMarkController',
        ]);
    }

    #[Route('/sync', name: 'admin_vehicle_mark_sync')]
    public function sync(MarkServices $markServices): Response
    {
        $markServices->SyncMark();
        return $this->redirectToRoute("public_product_index");
    }
}
