<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HotelRepository::class)
 */
class Hotel
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="integer")
     */
    private $etoiles;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="hotel")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pays;

    /**
     * @ORM\OneToMany(targetEntity=Images::class, mappedBy="hotel", orphanRemoval=true, cascade={"persist"})
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity=Offres::class, mappedBy="hotel")
     */
    private $offres;

    /**
     * @ORM\OneToMany(targetEntity=GrilleTarifaire::class, mappedBy="hotel")
     */
    private $grilleTarifaires;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->offres = new ArrayCollection();
        $this->grilleTarifaires = new ArrayCollection();
    }

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEtoiles(): ?int
    {
        return $this->etoiles;
    }

    public function setEtoiles(int $etoiles): self
    {
        $this->etoiles = $etoiles;

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
            $image->setHotel($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getHotel() === $this) {
                $image->setHotel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Offres>
     */
    public function getOffres(): Collection
    {
        return $this->offres;
    }

    public function addOffre(Offres $offre): self
    {
        if (!$this->offres->contains($offre)) {
            $this->offres[] = $offre;
            $offre->setHotel($this);
        }

        return $this;
    }

    public function removeOffre(Offres $offre): self
    {
        if ($this->offres->removeElement($offre)) {
            // set the owning side to null (unless already changed)
            if ($offre->getHotel() === $this) {
                $offre->setHotel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GrilleTarifaire>
     */
    public function getGrilleTarifaires(): Collection
    {
        return $this->grilleTarifaires;
    }

    public function addGrilleTarifaire(GrilleTarifaire $grilleTarifaire): self
    {
        if (!$this->grilleTarifaires->contains($grilleTarifaire)) {
            $this->grilleTarifaires[] = $grilleTarifaire;
            $grilleTarifaire->setHotel($this);
        }

        return $this;
    }

    public function removeGrilleTarifaire(GrilleTarifaire $grilleTarifaire): self
    {
        if ($this->grilleTarifaires->removeElement($grilleTarifaire)) {
            // set the owning side to null (unless already changed)
            if ($grilleTarifaire->getHotel() === $this) {
                $grilleTarifaire->setHotel(null);
            }
        }

        return $this;
    }
    public function __toString() {
        if(is_null($this->nom)) {
            return 'NULL';
        }    
        return (string) $this->nom;
     }
}
