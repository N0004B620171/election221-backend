<?php

namespace App\Entity;

use App\Repository\DetailsCirconscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailsCirconscriptionRepository::class)]
class DetailsCirconscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $posistionGeographique = null;

    #[ORM\Column]
    private ?int $nbreInscris = null;

    #[ORM\Column]
    private ?int $nbreSuffExprime = null;

    #[ORM\Column]
    private ?int $suffValable = null;

    #[ORM\Column]
    private ?int $suffInvalable = null;

    #[ORM\Column]
    private ?int $suffReparti = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPosistionGeographique(): ?string
    {
        return $this->posistionGeographique;
    }

    public function setPosistionGeographique(string $posistionGeographique): self
    {
        $this->posistionGeographique = $posistionGeographique;

        return $this;
    }

    public function getNbreInscris(): ?int
    {
        return $this->nbreInscris;
    }

    public function setNbreInscris(int $nbreInscris): self
    {
        $this->nbreInscris = $nbreInscris;

        return $this;
    }

    public function getNbreSuffExprime(): ?int
    {
        return $this->nbreSuffExprime;
    }

    public function setNbreSuffExprime(int $nbreSuffExprime): self
    {
        $this->nbreSuffExprime = $nbreSuffExprime;

        return $this;
    }

    public function getSuffValable(): ?int
    {
        return $this->suffValable;
    }

    public function setSuffValable(int $suffValable): self
    {
        $this->suffValable = $suffValable;

        return $this;
    }

    public function getSuffInvalable(): ?int
    {
        return $this->suffInvalable;
    }

    public function setSuffInvalable(int $suffInvalable): self
    {
        $this->suffInvalable = $suffInvalable;

        return $this;
    }

    public function getSuffReparti(): ?int
    {
        return $this->suffReparti;
    }

    public function setSuffReparti(int $suffReparti): self
    {
        $this->suffReparti = $suffReparti;

        return $this;
    }
}
