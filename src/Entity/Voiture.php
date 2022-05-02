<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use App\Traits\TimeStampTrait;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
#[orm\HasLifecycleCallbacks()]
class Voiture
{   use TimeStampTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Personnes::class, inversedBy: 'voiture')]
    private $personne;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $marque;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersonne(): ?Personnes
    {
        return $this->personne;
    }

    public function setPersonne(?Personnes $personne): self
    {
        $this->personne = $personne;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(?string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }
    public function __toString(): string
    {
        return $this->getMarque();
    }

   
}
