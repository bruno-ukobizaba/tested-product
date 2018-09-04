<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SolutionRepository")
 */
class Solution
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
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProduitTeste", mappedBy="solution")
     */
    private $produitTestes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Langue", inversedBy="solutions")
     */
    private $langue;

    public function __construct()
    {
        $this->produitTestes = new ArrayCollection();
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
     * @return Collection|ProduitTeste[]
     */
    public function getProduitTestes(): Collection
    {
        return $this->produitTestes;
    }

    public function addProduitTestis(ProduitTeste $produitTestis): self
    {
        if (!$this->produitTestes->contains($produitTestis)) {
            $this->produitTestes[] = $produitTestis;
            $produitTestis->setSolution($this);
        }

        return $this;
    }

    public function removeProduitTestis(ProduitTeste $produitTestis): self
    {
        if ($this->produitTestes->contains($produitTestis)) {
            $this->produitTestes->removeElement($produitTestis);
            // set the owning side to null (unless already changed)
            if ($produitTestis->getSolution() === $this) {
                $produitTestis->setSolution(null);
            }
        }

        return $this;
    }

    public function getLangue(): ?Langue
    {
        return $this->langue;
    }

    public function setLangue(?Langue $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    public function __toString(){
        return $this->getNom();
    }
}
