<?php

namespace App\Controller;

use App\Entity\Circonscription;
use App\Form\CirconscriptionType;
use App\Repository\CirconscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/circonscription')]
class CirconscriptionController extends AbstractController
{
    #[Route('/', name: 'app_circonscription_index', methods: ['GET'])]
    public function index(CirconscriptionRepository $circonscriptionRepository): Response
    {
        return $this->render('circonscription/index.html.twig', [
            'circonscriptions' => $circonscriptionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_circonscription_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CirconscriptionRepository $circonscriptionRepository): Response
    {
        $circonscription = new Circonscription();
        $form = $this->createForm(CirconscriptionType::class, $circonscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $circonscriptionRepository->save($circonscription, true);

            return $this->redirectToRoute('app_circonscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('circonscription/new.html.twig', [
            'circonscription' => $circonscription,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_circonscription_show', methods: ['GET'])]
    public function show(Circonscription $circonscription): Response
    {
        return $this->render('circonscription/show.html.twig', [
            'circonscription' => $circonscription,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_circonscription_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Circonscription $circonscription, CirconscriptionRepository $circonscriptionRepository): Response
    {
        $form = $this->createForm(CirconscriptionType::class, $circonscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $circonscriptionRepository->save($circonscription, true);

            return $this->redirectToRoute('app_circonscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('circonscription/edit.html.twig', [
            'circonscription' => $circonscription,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_circonscription_delete', methods: ['POST'])]
    public function delete(Request $request, Circonscription $circonscription, CirconscriptionRepository $circonscriptionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$circonscription->getId(), $request->request->get('_token'))) {
            $circonscriptionRepository->remove($circonscription, true);
        }

        return $this->redirectToRoute('app_circonscription_index', [], Response::HTTP_SEE_OTHER);
    }
}
