<?php

namespace App\Controller;

use App\Entity\Electeur;
use App\Form\ElecteurType;
use App\Repository\ElecteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

#[Route('/electeur')]
class ElecteurController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/", name="app_electeur_index")
     * Rest\View(StatusCode = 200)
     */



    // #[Route('/', name: 'app_electeur_index', methods: ['GET'])]
    public function index(ElecteurRepository $electeurRepository)
    {
        return $electeurRepository->findAll();
    }

    #[Route('/new', name: 'app_electeur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ElecteurRepository $electeurRepository): Response
    {
        $electeur = new Electeur();
        $form = $this->createForm(ElecteurType::class, $electeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $electeurRepository->save($electeur, true);

            return $this->redirectToRoute('app_electeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('electeur/new.html.twig', [
            'electeur' => $electeur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_electeur_show', methods: ['GET'])]
    public function show(Electeur $electeur): Response
    {
        return $this->render('electeur/show.html.twig', [
            'electeur' => $electeur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_electeur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Electeur $electeur, ElecteurRepository $electeurRepository): Response
    {
        $form = $this->createForm(ElecteurType::class, $electeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $electeurRepository->save($electeur, true);

            return $this->redirectToRoute('app_electeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('electeur/edit.html.twig', [
            'electeur' => $electeur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_electeur_delete', methods: ['POST'])]
    public function delete(Request $request, Electeur $electeur, ElecteurRepository $electeurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $electeur->getId(), $request->request->get('_token'))) {
            $electeurRepository->remove($electeur, true);
        }

        return $this->redirectToRoute('app_electeur_index', [], Response::HTTP_SEE_OTHER);
    }
}
