<?php

namespace App\Controller\Admin;

use App\Entity\Customer;
use App\Form\Admin\CustomerType;
use App\Repository\CustomerRepository;
use App\Services\CustomerServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/customer')]
class CustomerController extends AbstractController
{
    #[Route('/', name: 'admin_customer_index', methods: ['GET'])]
    public function index(CustomerRepository $customerRepository, CustomerServices $services): Response
    {
        return $this->render('admin/customer/index.html.twig', [
            'customers' => $customerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_customer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($customer);
            $entityManager->flush();

            return $this->redirectToRoute('admin_customer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/customer/new.html.twig', [
            'customer' => $customer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_customer_show', methods: ['GET'])]
    public function show(Customer $customer): Response
    {
        return $this->render('admin/customer/show.html.twig', [
            'customer' => $customer,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_customer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Customer $customer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_customer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/customer/edit.html.twig', [
            'customer' => $customer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_customer_delete', methods: ['POST'])]
    public function delete(Request $request, Customer $customer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$customer->getId(), $request->request->get('_token'))) {
            $entityManager->remove($customer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_customer_index', [], Response::HTTP_SEE_OTHER);
    }
}
