<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=AgentRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class Agent extends User
{
    /**
     * @ORM\ManyToOne(targetEntity=Agence::class, inversedBy="agent")
     * @ORM\JoinColumn(nullable=false)
     */
    private $agence;

    public function getAgence(): ?Agence
    {
        return $this->agence;
    }

    public function setAgence(?Agence $agence): self
    {
        $this->agence = $agence;

        return $this;
    }
}
