<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MelangeRepository")
 */
class Melange
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $concentration;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProduitTeste", inversedBy="melanges")
     */
    private $produitTeste;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProduitTeste", inversedBy="melangesProduitTeste")
     */
    private $produitMelange;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduitTeste(): ?ProduitTeste
    {
        return $this->produitTeste;
    }

    public function setProduitTeste(?ProduitTeste $produitTeste): self
    {
        $this->produitTeste = $produitTeste;

        return $this;
    }

    public function getProduitMelange(): ?ProduitTeste
    {
        return $this->produitMelange;
    }

    public function setProduitMelange(?ProduitTeste $produitMelange): self
    {
        $this->produitMelange = $produitMelange;

        return $this;
    }

    public function getConcentration(): ?string
    {
        return $this->concentration;
    }

    public function setConcentration(?string $concentration): self
    {
        $this->concentration = $concentration;

        return $this;
    }

}
