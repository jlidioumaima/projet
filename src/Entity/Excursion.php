<?php

namespace App\Entity;
use App\Entity\Offres;
use App\Repository\ExcursionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExcursionRepository::class)
 */
class Excursion extends Offres
{
   
}
