<?php

namespace App\Controller;

use App\Entity\Business;
use App\Form\BusinessType;
use App\Repository\BusinessRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BusinessController extends AbstractController
{
    #[Route('/admin', name: 'app_business_index', methods: ['GET'])]
    public function index(BusinessRepository $businessRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('business/index.html.twig', [
            'businesses' => $businessRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_business_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BusinessRepository $businessRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $business = new Business();
        $form = $this->createForm(BusinessType::class, $business);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $businessRepository->save($business, true);

            return $this->redirectToRoute('app_business_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('business/new.html.twig', [
            'business' => $business,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_business_show', methods: ['GET'])]
    public function show(Business $business): Response
    {
        return $this->render('business/show.html.twig', [
            'business' => $business,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_business_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Business $business, BusinessRepository $businessRepository): Response
    {

        $this->denyAccessUnlessGranted('ROLE_USER');
        $form = $this->createForm(BusinessType::class, $business);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $businessRepository->save($business, true);

            return $this->redirectToRoute('app_business_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('business/edit.html.twig', [
            'business' => $business,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_business_delete', methods: ['POST'])]
    public function delete(Request $request, Business $business, BusinessRepository $businessRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$business->getId(), $request->request->get('_token'))) {
            $businessRepository->remove($business, true);
        }

        return $this->redirectToRoute('app_business_index', [], Response::HTTP_SEE_OTHER);
    }
}
