<?php

namespace App\Entity;

use App\Repository\OffresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OffresRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 * "offre" = "App\Entity\Offres",
 *  "omra" = "App\Entity\Omra",
 *  "randonnee" = "App\Entity\Rondonnee",
 * "croisiere" = "App\Entity\Croisiere",
 * "excursion" = "App\Entity\Excursion",
 *  "voyageorganiser" = "App\Entity\VoyageOrganiser"})
 * @ORM\HasLifecycleCallbacks()
 */
class Offres
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $totalRate;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $inclus;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Non_Inclus;

    /**
     * @ORM\OneToMany(targetEntity=Images::class, mappedBy="offres", orphanRemoval=true, cascade={"persist"})
     */
    private $images;

    /**
     * @ORM\ManyToOne(targetEntity=Agence::class, inversedBy="offres")
     */
    private $agence;

    /**
     * @ORM\ManyToOne(targetEntity=Hotel::class, inversedBy="offres")
     */
    private $hotel;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="offres")
     */
    private $pays;

    /**
     * @ORM\OneToMany(targetEntity=Categorie::class, mappedBy="offre")
     */
    private $categories;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTotalRate(): ?float
    {
        return $this->totalRate;
    }

    public function setTotalRate(float $totalRate): self
    {
        $this->totalRate = $totalRate;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getInclus(): ?string
    {
        return $this->inclus;
    }

    public function setInclus(string $inclus): self
    {
        $this->inclus = $inclus;

        return $this;
    }

    public function getNonInclus(): ?string
    {
        return $this->Non_Inclus;
    }

    public function setNonInclus(string $Non_Inclus): self
    {
        $this->Non_Inclus = $Non_Inclus;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setOffres($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getOffres() === $this) {
                $image->setOffres(null);
            }
        }

        return $this;
    }

    public function getAgence(): ?Agence
    {
        return $this->agence;
    }

    public function setAgence(?Agence $agence): self
    {
        $this->agence = $agence;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setOffre($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getOffre() === $this) {
                $category->setOffre(null);
            }
        }

        return $this;
    }
}
