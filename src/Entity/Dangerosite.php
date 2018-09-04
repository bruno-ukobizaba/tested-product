<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DangerositeRepository")
 */
class Dangerosite
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
    private $typeDanger;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phraseRisque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $urlPicto;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProduitTeste", mappedBy="dangerosite")
     */
    private $produitTestes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Langue", inversedBy="dangerosites")
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

    public function getTypeDanger(): ?string
    {
        return $this->typeDanger;
    }

    public function setTypeDanger(string $typeDanger): self
    {
        $this->typeDanger = $typeDanger;

        return $this;
    }

    public function getPhraseRisque(): ?string
    {
        return $this->phraseRisque;
    }

    public function setPhraseRisque(string $phraseRisque): self
    {
        $this->phraseRisque = $phraseRisque;

        return $this;
    }

    public function getUrlPicto(): ?string
    {
        return $this->urlPicto;
    }

    public function setUrlPicto(string $urlPicto): self
    {
        $this->urlPicto = $urlPicto;

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
            $produitTestis->setDangerosite($this);
        }

        return $this;
    }

    public function removeProduitTestis(ProduitTeste $produitTestis): self
    {
        if ($this->produitTestes->contains($produitTestis)) {
            $this->produitTestes->removeElement($produitTestis);
            // set the owning side to null (unless already changed)
            if ($produitTestis->getDangerosite() === $this) {
                $produitTestis->setDangerosite(null);
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
        return (string) $this->getTypeDanger().' - '.$this->getPhraseRisque();
    }

}
