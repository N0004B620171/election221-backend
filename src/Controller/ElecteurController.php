<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\Circonscription;
use App\Entity\DetailsCirconscription;
use App\Entity\User;
use App\Form\ElecteurType;
use App\Repository\DetailsCirconscriptionRepository;
use App\Repository\ElecteurRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/electeur')]
class ElecteurController extends AbstractFOSRestController
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }


    /**
     * @Rest\Get("/", name="app_electeur_index")
     * Rest\View(StatusCode = 200)
     */

    // #[Route('/', name: 'app_electeur_index', methods: ['GET'])]
    public function index(UserRepository $electeurRepository)
    {
        return $electeurRepository->findAll();
    }
    /**
     * @Rest\Get("/chercherByEmail/{email}", name="app_electr_index")
     * Rest\View(StatusCode = 200)
     */

    // #[Route('/chercherByEmail/{email}', name: 'app_electr_index', methods: ['GET'])]
    public function chercheByEmail(Request $request, UserRepository $electeurRepository)
    {
        return $electeurRepository->findOneByEmail($request->get('email'));
    }
    /**
     * @Rest\Post("/new", name="app_electeur_new")
     * Rest\View(StatusCode = 200)
     */
    public function new(Request $request, EntityManagerInterface $em, DetailsCirconscriptionRepository $detailsCirconscriptionRepository, UserRepository $electeurRepository)
    {
        $detailsCirconscription = new DetailsCirconscription();
        $electeur = new User();
        $circonscription = new Circonscription();
        $electeur->setEmail($request->get('email'));
        $electeur->setPassword($this->userPasswordHasher->hashPassword($electeur, $request->get('password')));
        $electeur->setRoles(["ROLE_USER"]);
        $electeur->setPrenom($request->get('prenom'));
        $electeur->setNom($request->get('nom'));
        $electeur->setCni($request->get('cni'));
        $electeur->setIsCandidat(false);
        $electeur->setDateNaiss(new \DateTime());
        $electeur->setAdresse($request->get('adresse'));
        $detailsCirconscription = $detailsCirconscriptionRepository->findAll(array(), array('id' => 'DESC'))[0];
        $nbreInscris = $detailsCirconscription->getNbreInscris();
        $detailsCirconscription->setNbreInscris($nbreInscris + 1);
        $detailsCirconscription->setNbreInscris($nbreInscris + 1);
        $id = $detailsCirconscription->getId() + 1;
        $detailsCirconscription->setId($id);
        $circonscription->setRegion($request->get('region'));
        $circonscription->setDepartement($request->get('departement'));
        $circonscription->setCommune($request->get('commune'));
        $electeur->setCirconscription($circonscription);
        $em->persist($detailsCirconscription);
        $em->persist($electeur);
        $em->flush();
        return $electeur;
    }
    /**
     * @Rest\Patch("/voter", name="app_electeur_voter")
     * Rest\View(StatusCode = 200)
     */
    public function voter(Request $request, EntityManagerInterface $em, DetailsCirconscriptionRepository $detailsCirconscriptionRepository, UserRepository $electeurRepository)
    {
        $candidat = new Candidat();
        $detailsCirconscription = new DetailsCirconscription();
        $electeur = new User();
        $electeur = $electeurRepository->findOneByCni($request->get('cnivotant'));
        if (empty($electeur->getcandidat())) {
            $candidat->setPrenom($request->get('prenom'));
            $candidat->setNom($request->get('nom'));
            $candidat->setCni($request->get('cni'));
            // $electeur->setDateNaiss($request->get('datenaiss'));
            $candidat->setDateNaiss(new \DateTime());
            $candidat->setIdentification($request->get('identification'));
            $candidat->setAdresse($request->get('adresse'));
            $candidat->setNomParti($request->get('nomparti'));
            $electeur->setCandidat($candidat);
            $detailsCirconscription = $detailsCirconscriptionRepository->findAll()[0];
            $nbreSuffExprime = $detailsCirconscription->getNbreSuffExprime();
            $detailsCirconscription->setNbreSuffExprime($nbreSuffExprime + 1);
            $suffValable = $detailsCirconscription->getSuffValable();
            $detailsCirconscription->setSuffValable($suffValable + 1);
            $em->persist($candidat);
            $em->persist($electeur);
            $em->persist($detailsCirconscription);
            $em->flush();
            return $electeur;
        } else {
            return "Vous avez deja voter";
        }
    }
    //     #[Route('/{id}', name: 'app_electeur_show', methods: ['GET'])]
    //     public function show(User $electeur): Response
    //     {
    //         return $this->render('electeur/show.html.twig', [
    //             'electeur' => $electeur,
    //         ]);
    //     }

    //     #[Route('/{id}/edit', name: 'app_electeur_edit', methods: ['GET', 'POST'])]
    //     public function edit(Request $request, User $electeur, UserRepository $electeurRepository): Response
    //     {
    //         $form = $this->createForm(ElecteurType::class, $electeur);
    //         $form->handleRequest($request);

    //         if ($form->isSubmitted() && $form->isValid()) {
    //             $electeurRepository->save($electeur, true);

    //             return $this->redirectToRoute('app_electeur_index', [], Response::HTTP_SEE_OTHER);
    //         }

    //         return $this->renderForm('electeur/edit.html.twig', [
    //             'electeur' => $electeur,
    //             'form' => $form,
    //         ]);
    //     }

    //     #[Route('/{id}', name: 'app_electeur_delete', methods: ['POST'])]
    //     public function delete(Request $request, User $electeur, UserRepository $electeurRepository): Response
    //     {
    //         if ($this->isCsrfTokenValid('delete' . $electeur->getId(), $request->request->get('_token'))) {
    //             $electeurRepository->remove($electeur, true);
    //         }

    //         return $this->redirectToRoute('app_electeur_index', [], Response::HTTP_SEE_OTHER);
    //     }
}
