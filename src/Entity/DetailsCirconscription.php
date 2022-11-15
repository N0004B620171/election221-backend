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

    #[ORM\Column(nullable: true)]
    private ?int $nbreInscris = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbreSuffExprime = null;

    #[ORM\Column(nullable: true)]
    private ?int $suffValable = null;

    #[ORM\Column(nullable: true)]
    private ?int $suffInvalable = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $i)
    {
         $this->id=$i;
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
    public function __toString()
    {
        return $this->suffValable;
    }
}
