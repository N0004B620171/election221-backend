<?php

namespace App\Entity;

use App\Repository\CandidatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidatRepository::class)]
class Candidat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomParti = null;

    #[ORM\Column(length: 255)]
    private ?string $identification = null;

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

    #[ORM\OneToOne(mappedBy: 'candidat', cascade: ['persist', 'remove'])]
    private ?Electeur $electeur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomParti(): ?string
    {
        return $this->nomParti;
    }

    public function setNomParti(string $nomParti): self
    {
        $this->nomParti = $nomParti;

        return $this;
    }

    public function getIdentification(): ?string
    {
        return $this->identification;
    }

    public function setIdentification(string $identification): self
    {
        $this->identification = $identification;

        return $this;
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

    public function getElecteur(): ?Electeur
    {
        return $this->electeur;
    }

    public function setElecteur(?Electeur $electeur): self
    {
        // unset the owning side of the relation if necessary
        if ($electeur === null && $this->electeur !== null) {
            $this->electeur->setCandidat(null);
        }

        // set the owning side of the relation if necessary
        if ($electeur !== null && $electeur->getCandidat() !== $this) {
            $electeur->setCandidat($this);
        }

        $this->electeur = $electeur;

        return $this;
    }
    public function __toString()
    {
        return $this->cni;
    }
}
