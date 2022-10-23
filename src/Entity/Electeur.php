<?php

namespace App\Entity;

use App\Repository\ElecteurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ElecteurRepository::class)]
class Electeur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $cni = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaiss = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $nomCentreVote = null;

    #[ORM\Column]
    private ?int $numBureauVote = null;

    #[ORM\ManyToOne(inversedBy: 'electeurs')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Circonscription $circonscription = null;

    #[ORM\OneToOne(inversedBy: 'electeur', cascade: ['persist', 'remove'])]
    private ?Candidat $candidat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCni(): ?string
    {
        return $this->cni;
    }

    public function setCni(string $cni): self
    {
        $this->cni = $cni;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaiss(): ?\DateTimeInterface
    {
        return $this->dateNaiss;
    }

    public function setDateNaiss(\DateTimeInterface $dateNaiss): self
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNomCentreVote(): ?string
    {
        return $this->nomCentreVote;
    }

    public function setNomCentreVote(string $nomCentreVote): self
    {
        $this->nomCentreVote = $nomCentreVote;

        return $this;
    }

    public function getNumBureauVote(): ?int
    {
        return $this->numBureauVote;
    }

    public function setNumBureauVote(int $numBureauVote): self
    {
        $this->numBureauVote = $numBureauVote;

        return $this;
    }

    public function getCirconscription(): ?Circonscription
    {
        return $this->circonscription;
    }

    public function setCirconscription(?Circonscription $circonscription): self
    {
        $this->circonscription = $circonscription;

        return $this;
    }

    public function getCandidat(): ?Candidat
    {
        return $this->candidat;
    }

    public function setCandidat(?Candidat $candidat): self
    {
        $this->candidat = $candidat;

        return $this;
    }
    public function __toString()
    {
        return $this->cni;
    }

}
