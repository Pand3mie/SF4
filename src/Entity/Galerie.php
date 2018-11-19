<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GalerieRepository")
 */
class Galerie
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
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Ajouter une image jpg")
     * @Assert\File(mimeTypes={ "image/jpeg" })
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="galeries")
     */
    private $user_galerie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categorie;

    /**
     *  @ORM\Column(type="integer", nullable=true)
     */
    private $star;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Avis", mappedBy="avis_image")
     */
    private $avis;

    public function __construct()
    {
        $this->avis = new ArrayCollection();
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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getUserGalerie(): ?user
    {
        return $this->user_galerie;
    }

    public function setUserGalerie(?user $user_galerie): self
    {
        $this->user_galerie = $user_galerie;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get the value of star
     */ 
    public function getStar()
    {
        return $this->star;
    }

    /**
     * Set the value of star
     *
     * @return  self
     */ 
    public function setStar($star)
    {
        $this->star = $star;

        return $this;
    }

    /**
     * @return Collection|Avis[]
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis[] = $avi;
            $avi->setAvisImage($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): self
    {
        if ($this->avis->contains($avi)) {
            $this->avis->removeElement($avi);
            // set the owning side to null (unless already changed)
            if ($avi->getAvisImage() === $this) {
                $avi->setAvisImage(null);
            }
        }

        return $this;
    }

}
