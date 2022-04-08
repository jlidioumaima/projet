<?php

namespace App\Entity;
use App\Entity\Offres;
use App\Repository\CroisiereRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CroisiereRepository::class)
 */
class Croisiere extends Offres
{
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $excursion;

   

    public function getExcursion(): ?string
    {
        return $this->excursion;
    }

    public function setExcursion(string $excursion): self
    {
        $this->excursion = $excursion;

        return $this;
    }
}
