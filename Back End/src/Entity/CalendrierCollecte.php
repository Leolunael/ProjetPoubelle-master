<?php

namespace App\Entity;

use App\Repository\CalendrierCollecteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalendrierCollecteRepository::class)]
class CalendrierCollecte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $typeDechet = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $jourCollecte = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $remarque = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTypeDechet(): ?string
    {
        return $this->typeDechet;
    }

    public function setTypeDechet(string $typeDechet): static
    {
        $this->typeDechet = $typeDechet;

        return $this;
    }

    public function getJourCollecte(): ?\DateTime
    {
        return $this->jourCollecte;
    }

    public function setJourCollecte(\DateTime $jourCollecte): static
    {
        $this->jourCollecte = $jourCollecte;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(?string $remarque): static
    {
        $this->remarque = $remarque;

        return $this;
    }
}
