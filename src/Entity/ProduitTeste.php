<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitTesteRepository")
 */
class ProduitTeste
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $IUPAC;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numeroCAS;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modifiedAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isMelange;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isTested;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToMany(
     * targetEntity="Caracteristique",
     * mappedBy="produitTeste",
     * orphanRemoval=true,
     * cascade={"persist"}
     * )
     */
    private $caracteristiques;

    /**
     * @ORM\OneToMany(
     * targetEntity="Melange", 
     * mappedBy="produitTeste",
     * orphanRemoval=true,
     * cascade={"persist"}
     * )
     */
    private $melanges;

    /**
     * @ORM\OneToMany(
     * targetEntity="Fichier", 
     * mappedBy="produitTeste",
     * orphanRemoval=true,
     * cascade={"persist"}
     * )
     */
    private $fichiers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dangerosite", inversedBy="produitTestes")
     */
    private $dangerosite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Solution", inversedBy="produitTestes")
     */
    private $solution;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Melange", mappedBy="produitMelange")
     */
    private $melangesProduitTeste;

    public function __construct()
    {
        $this->caracteristique = new ArrayCollection();
        $this->melanges = new ArrayCollection();
        $this->fichiers = new ArrayCollection();
        $this->caracteristiques = new ArrayCollection();
        $this->melangesProduitTeste = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIUPAC(): ?string
    {
        return $this->IUPAC;
    }

    public function setIUPAC(string $IUPAC): self
    {
        $this->IUPAC = $IUPAC;

        return $this;
    }

    public function getNumeroCAS(): ?string
    {
        return $this->numeroCAS;
    }

    public function setNumeroCAS(string $numeroCAS): self
    {
        $this->numeroCAS = $numeroCAS;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(?\DateTimeInterface $modifiedAt): self
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    public function getIsMelange(): ?bool
    {
        return $this->isMelange;
    }

    public function setIsMelange(bool $isMelange): self
    {
        $this->isMelange = $isMelange;

        return $this;
    }

    public function getIsTested(): ?bool
    {
        return $this->isTested;
    }

    public function setIsTested(bool $isTested): self
    {
        $this->isTested = $isTested;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection|Caracteristique[]
     */
    public function getCaracteristique(): Collection
    {
        return $this->caracteristique;
    }

    public function addCaracteristique(Caracteristique $caracteristique): self
    {
        if (!$this->caracteristiques->contains($caracteristique)) {
            $this->caracteristiques[] = $caracteristique;
            $caracteristique->setProduitTeste($this);
        }

        return $this;
    }

    public function removeCaracteristique(Caracteristique $caracteristique): self
    {
        if ($this->caracteristiques->contains($caracteristique)) {
            $this->caracteristiques->removeElement($caracteristique);
            // set the owning side to null (unless already changed)
            if ($caracteristique->getProduitTeste() === $this) {
                $caracteristique->setProduitTeste(null);
            }
        }

        return $this;
    }

    public function getDangerosite(): ?Dangerosite
    {
        return $this->dangerosite;
    }

    public function setDangerosite(?Dangerosite $dangerosite): self
    {
        $this->dangerosite = $dangerosite;

        return $this;
    }

    /**
     * @return Collection|Melange[]
     */
    public function getMelanges(): Collection
    {
        return $this->melanges;
    }

    public function addMelange(Melange $melange): self
    {
        if (!$this->melanges->contains($melange)) {
            $this->melanges[] = $melange;
            $melange->setProduitTeste($this);
        }

        return $this;
    }

    public function removeMelange(Melange $melange): self
    {
        if ($this->melanges->contains($melange)) {
            $this->melanges->removeElement($melange);
            // set the owning side to null (unless already changed)
            if ($melange->getProduitTeste() === $this) {
                $melange->setProduitTeste(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Fichier[]
     */
    public function getFichiers(): Collection
    {
        return $this->fichiers;
    }

    public function addFichier(Fichier $fichier): self
    {
        if (!$this->fichiers->contains($fichier)) {
            $this->fichiers[] = $fichier;
            $fichier->setProduitTeste($this);
        }

        return $this;
    }

    public function removeFichier(Fichier $fichier): self
    {
        if ($this->fichiers->contains($fichier)) {
            $this->fichiers->removeElement($fichier);
            // set the owning side to null (unless already changed)
            if ($fichier->getProduitTeste() === $this) {
                $fichier->setProduitTeste(null);
            }
        }

        return $this;
    }

    public function getSolution(): ?Solution
    {
        return $this->solution;
    }

    public function setSolution(?Solution $solution): self
    {
        $this->solution = $solution;

        return $this;
    }

    /**
     * @return Collection|Caracteristique[]
     */
    public function getCaracteristiques(): Collection
    {
        return $this->caracteristiques;
    }

    /**
     * @return Collection|Melange[]
     */
    public function getMelangesProduitTeste(): Collection
    {
        return $this->melangesProduitTeste;
    }

    public function addMelangesProduitTeste(Melange $melangesProduitTeste): self
    {
        if (!$this->melangesProduitTeste->contains($melangesProduitTeste)) {
            $this->melangesProduitTeste[] = $melangesProduitTeste;
            $melangesProduitTeste->setProduitMelange($this);
        }

        return $this;
    }

    public function removeMelangesProduitTeste(Melange $melangesProduitTeste): self
    {
        if ($this->melangesProduitTeste->contains($melangesProduitTeste)) {
            $this->melangesProduitTeste->removeElement($melangesProduitTeste);
            // set the owning side to null (unless already changed)
            if ($melangesProduitTeste->getProduitMelange() === $this) {
                $melangesProduitTeste->setProduitMelange(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->getIUPAC();
    }

}
