<?php

namespace App\Entity;

use App\Repository\CirconscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CirconscriptionRepository::class)]
class Circonscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $region = null;

    #[ORM\Column(length: 255)]
    private ?string $departement = null;

    #[ORM\Column(length: 255)]
    private ?string $commune = null;

    

    #[ORM\OneToMany(mappedBy: 'circonscription', targetEntity: User::class)]
    private Collection $electeurs;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?DetailsCirconscription $detailsCirconscription = null;

    public function __construct()
    {
        $this->electeurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(string $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

   

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(string $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getElecteurs(): Collection
    {
        return $this->electeurs;
    }

    public function addUser(User $electeur): self
    {
        if (!$this->electeurs->contains($electeur)) {
            $this->electeurs->add($electeur);
            $electeur->setCirconscription($this);
        }

        return $this;
    }

    public function removeElecteur(User $electeur): self
    {
        if ($this->electeurs->removeElement($electeur)) {
            // set the owning side to null (unless already changed)
            if ($electeur->getCirconscription() === $this) {
                $electeur->setCirconscription(null);
            }
        }

        return $this;
    }

    public function getDetailsCirconscription(): ?DetailsCirconscription
    {
        return $this->detailsCirconscription;
    }

    public function setDetailsCirconscription(DetailsCirconscription $detailsCirconscription): self
    {
        $this->detailsCirconscription = $detailsCirconscription;

        return $this;
    }
    public function __toString()
    {
        return $this->region;
    }
}
