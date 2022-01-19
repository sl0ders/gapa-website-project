<?php

namespace App\Controller\Admin;

use App\Entity\VehicleDeclination;
use App\Form\VehicleDeclinationType;
use App\Repository\VehicleDeclinationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/declination')]
class VehicleDeclinationController extends AbstractController
{
    #[Route('/', name: 'admin_declination_index', methods: ['GET'])]
    public function index(VehicleDeclinationRepository $vehicleDeclinationRepository, PaginatorInterface $paginator): Response
    {
        $vehicleDeclination = $vehicleDeclinationRepository->findAll();
       $pagination = $paginator->paginate(
            $vehicleDeclination,
            1,
            30
        );
        return $this->render('admin/vehicle_declination/index.html.twig', [
            'paginator' => $pagination,
        ]);
    }

    #[Route('/new', name: 'admin_declination_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vehicleDeclination = new VehicleDeclination();
        $form = $this->createForm(VehicleDeclinationType::class, $vehicleDeclination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vehicleDeclination);
            $entityManager->flush();

            return $this->redirectToRoute('admin_declination_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/vehicle_declination/new.html.twig', [
            'vehicle_declination' => $vehicleDeclination,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_declination_show', methods: ['GET'])]
    public function show(VehicleDeclination $vehicleDeclination): Response
    {
        return $this->render('admin/vehicle_declination/show.html.twig', [
            'vehicle_declination' => $vehicleDeclination,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_declination_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, VehicleDeclination $vehicleDeclination, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VehicleDeclinationType::class, $vehicleDeclination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_declination_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/vehicle_declination/edit.html.twig', [
            'vehicle_declination' => $vehicleDeclination,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_declination_delete', methods: ['POST'])]
    public function delete(Request $request, VehicleDeclination $vehicleDeclination, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $vehicleDeclination->getId(), $request->request->get('_token'))) {
            $entityManager->remove($vehicleDeclination);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_declination_index', [], Response::HTTP_SEE_OTHER);
    }
}
