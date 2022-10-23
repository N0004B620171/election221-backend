<?php

namespace App\Controller;

use App\Entity\DetailsCirconscription;
use App\Form\DetailsCirconscriptionType;
use App\Repository\DetailsCirconscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/details/circonscription')]
class DetailsCirconscriptionController extends AbstractController
{
    #[Route('/', name: 'app_details_circonscription_index', methods: ['GET'])]
    public function index(DetailsCirconscriptionRepository $detailsCirconscriptionRepository): Response
    {
        return $this->render('details_circonscription/index.html.twig', [
            'details_circonscriptions' => $detailsCirconscriptionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_details_circonscription_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DetailsCirconscriptionRepository $detailsCirconscriptionRepository): Response
    {
        $detailsCirconscription = new DetailsCirconscription();
        $form = $this->createForm(DetailsCirconscriptionType::class, $detailsCirconscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $detailsCirconscriptionRepository->save($detailsCirconscription, true);

            return $this->redirectToRoute('app_details_circonscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('details_circonscription/new.html.twig', [
            'details_circonscription' => $detailsCirconscription,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_details_circonscription_show', methods: ['GET'])]
    public function show(DetailsCirconscription $detailsCirconscription): Response
    {
        return $this->render('details_circonscription/show.html.twig', [
            'details_circonscription' => $detailsCirconscription,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_details_circonscription_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DetailsCirconscription $detailsCirconscription, DetailsCirconscriptionRepository $detailsCirconscriptionRepository): Response
    {
        $form = $this->createForm(DetailsCirconscriptionType::class, $detailsCirconscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $detailsCirconscriptionRepository->save($detailsCirconscription, true);

            return $this->redirectToRoute('app_details_circonscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('details_circonscription/edit.html.twig', [
            'details_circonscription' => $detailsCirconscription,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_details_circonscription_delete', methods: ['POST'])]
    public function delete(Request $request, DetailsCirconscription $detailsCirconscription, DetailsCirconscriptionRepository $detailsCirconscriptionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$detailsCirconscription->getId(), $request->request->get('_token'))) {
            $detailsCirconscriptionRepository->remove($detailsCirconscription, true);
        }

        return $this->redirectToRoute('app_details_circonscription_index', [], Response::HTTP_SEE_OTHER);
    }
}
