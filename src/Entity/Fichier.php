<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FichierRepository")
 */
class Fichier
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
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isRestricted;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProduitTeste", inversedBy="fichiers")
     */
    private $produitTeste;

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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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

    public function getIsRestricted(): ?bool
    {
        return $this->isRestricted;
    }

    public function setIsRestricted(bool $isRestricted): self
    {
        $this->isRestricted = $isRestricted;

        return $this;
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
    public function __toString(){
        return (string) $this->getNom();
    }
}
