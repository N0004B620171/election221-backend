<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\User;
use App\Form\CandidatType;
use App\Repository\CandidatRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;


#[Route('/candidat')]
class CandidatController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/", name="app_candidat_index")
     * Rest\View(StatusCode = 200)
     */
    // #[Route('/', name: 'app_candidat_index', methods: ['GET'])]
    public function index(CandidatRepository $candidatRepository)
    {
        return $candidatRepository->findAll();
    }
    /**
     * @Rest\Get("/resultat", name="app_canat_index")
     * Rest\View(StatusCode = 200)
     */
    // #[Route('/', name: 'app_candidat_index', methods: ['GET'])]
    public function resultat(CandidatRepository $candidatRepository)
    {
        return $candidatRepository->findAll();
    }

    /**
     * @Rest\Post("/new", name="app_candidat_new")
     * Rest\View(StatusCode = 200)
     */
    public function new(Request $request, EntityManagerInterface $em, UserRepository $electeurRepository, CandidatRepository $candidatRepository)
    {
        $electeur = new User();
        $electeur = $electeurRepository->findOneByCni($request->get('cni'));
        if (!empty($electeur)) {

            if (empty($candidatRepository->findOneByCni($request->get('cni')))) {
                $candidat = new Candidat();
                $candidat->setPrenom($request->get('prenom'));
                $candidat->setNom($request->get('nom'));
                $candidat->setNomParti($request->get('nomparti'));
                $candidat->setCni($request->get('cni'));
                $candidat->setAdresse($request->get('adresse'));
                $candidat->setDateNaiss(new \DateTime());
                $candidat->setIdentification($request->get('identification'));
                $electeur->setIsCandidat(true);
                $em->persist($electeur);
                $em->persist($candidat);
                $em->flush();
                return $candidat;
            } else {
                return "Vous etes deja candidat";
            }
        } else {
            return "Vous ne pouvez pas etre candidat car vous n'etes pas electeur";
        }
    }

    #[Route('/{id}', name: 'app_candidat_show', methods: ['GET'])]
    public function show(Candidat $candidat): Response
    {
        return $this->render('candidat/show.html.twig', [
            'candidat' => $candidat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_candidat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Candidat $candidat, CandidatRepository $candidatRepository): Response
    {
        $form = $this->createForm(CandidatType::class, $candidat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $candidatRepository->save($candidat, true);

            return $this->redirectToRoute('app_candidat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('candidat/edit.html.twig', [
            'candidat' => $candidat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_candidat_delete', methods: ['POST'])]
    public function delete(Request $request, Candidat $candidat, CandidatRepository $candidatRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $candidat->getId(), $request->request->get('_token'))) {
            $candidatRepository->remove($candidat, true);
        }

        return $this->redirectToRoute('app_candidat_index', [], Response::HTTP_SEE_OTHER);
    }
}
