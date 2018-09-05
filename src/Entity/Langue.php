<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LangueRepository")
 */
class Langue
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
    private $nom;

        /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $label;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $urlImage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToMany(
     * targetEntity="App\Entity\Caracteristique", 
     * mappedBy="langue",
     * orphanRemoval=true,
     * cascade={"persist"}     * 
     * )
     */
    private $caracteristiques;

    /**
     * @ORM\OneToMany(
     * targetEntity="App\Entity\Dangerosite", 
     * mappedBy="langue",
     * orphanRemoval=true,
     * cascade={"persist"}
     * )
     */
    private $dangerosites;

    /**
     * @ORM\OneToMany(
     * targetEntity="App\Entity\Solution", 
     * mappedBy="langue",
     * orphanRemoval=true,
     * cascade={"persist"}
     * )
     */
    private $solutions;

    public function __construct()
    {
        $this->caracteristiques = new ArrayCollection();
        $this->dangerosites = new ArrayCollection();
        $this->solutions = new ArrayCollection();
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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getUrlImage(): ?string
    {
        return $this->urlImage;
    }

    public function setUrlImage(string $urlImage): self
    {
        $this->urlImage = $urlImage;

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
    public function getCaracteristiques(): Collection
    {
        return $this->caracteristiques;
    }

    public function addCaracteristique(Caracteristique $caracteristique): self
    {
        if (!$this->caracteristiques->contains($caracteristique)) {
            $this->caracteristiques[] = $caracteristique;
            $caracteristique->setLangue($this);
        }

        return $this;
    }

    public function removeCaracteristique(Caracteristique $caracteristique): self
    {
        if ($this->caracteristiques->contains($caracteristique)) {
            $this->caracteristiques->removeElement($caracteristique);
            // set the owning side to null (unless already changed)
            if ($caracteristique->getLangue() === $this) {
                $caracteristique->setLangue(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Dangerosite[]
     */
    public function getDangerosites(): Collection
    {
        return $this->dangerosites;
    }

    public function addDangerosite(Dangerosite $dangerosite): self
    {
        if (!$this->dangerosites->contains($dangerosite)) {
            $this->dangerosites[] = $dangerosite;
            $dangerosite->setLangue($this);
        }

        return $this;
    }

    public function removeDangerosite(Dangerosite $dangerosite): self
    {
        if ($this->dangerosites->contains($dangerosite)) {
            $this->dangerosites->removeElement($dangerosite);
            // set the owning side to null (unless already changed)
            if ($dangerosite->getLangue() === $this) {
                $dangerosite->setLangue(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Solution[]
     */
    public function getSolutions(): Collection
    {
        return $this->solutions;
    }

    public function addSolution(Solution $solution): self
    {
        if (!$this->solutions->contains($solution)) {
            $this->solutions[] = $solution;
            $solution->setLangue($this);
        }

        return $this;
    }

    public function removeSolution(Solution $solution): self
    {
        if ($this->solutions->contains($solution)) {
            $this->solutions->removeElement($solution);
            // set the owning side to null (unless already changed)
            if ($solution->getLangue() === $this) {
                $solution->setLangue(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->getLabel();
    }

}
