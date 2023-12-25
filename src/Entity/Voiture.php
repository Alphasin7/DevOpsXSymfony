<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $serie = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_mise_en_marche = null;

    #[ORM\Column(length: 255)]
    private ?string $modele = null;

    #[ORM\Column]
    private ?float $prix_jour = null;

    #[ORM\ManyToOne(inversedBy: 'voitures')]
    private ?Modele $marque = null;








    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSerie(): ?string
    {
        return $this->serie;
    }

    public function setSerie(string $serie): static
    {
        $this->serie = $serie;

        return $this;
    }

    public function getDateMiseEnMarche(): ?\DateTimeInterface
    {
        return $this->date_mise_en_marche;
    }

    public function setDateMiseEnMarche(\DateTimeInterface $date_mise_en_marche): static
    {
        $this->date_mise_en_marche = $date_mise_en_marche;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    public function getPrixJour(): ?float
    {
        return $this->prix_jour;
    }

    public function setPrixJour(float $prix_jour): static
    {
        $this->prix_jour = $prix_jour;

        return $this;
    }

    public function getMarque(): ?Modele
    {
        return $this->marque;
    }

    public function setMarque(?Modele $marque): static
    {
        $this->marque = $marque;

        return $this;
    }




}
