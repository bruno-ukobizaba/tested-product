<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * @ORM\Entity(repositoryClass="App\Repository\DangerositeRepository")
 * @Vich\Uploadable
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
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="urlPicto")
     * @var File
     */
    private $imageFile;


    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $urlPicto;


    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToMany(
     * targetEntity="App\Entity\ProduitTeste", 
     * mappedBy="dangerosite",
     * orphanRemoval=true,
     * cascade={"persist"}
     * )
     */
    private $produitTestes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Langue", inversedBy="dangerosites")
     */
    private $langue;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

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

    public function setUrlPicto(?string $urlPicto): self
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
    
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile $image
     */
    public function setImageFile(File $image = null): void
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if (null !== $image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

}
