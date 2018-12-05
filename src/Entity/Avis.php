<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvisRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Avis
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
    private $author;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $create_at;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Galerie", inversedBy="avis",cascade={"persist"})
     * @ORM\JoinColumn(name="avis_image_id", referencedColumnName="id")
     */
    private $avis_image;

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        if (!$this->getCreateAt()) {
            $this->setCreateAt(new \DateTime());
        }

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->create_at;
    }

    public function setCreateAt(\DateTimeInterface $create_at): self
    {
        $this->create_at = $create_at;

        return $this;
    }


    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of avis_image
     */ 
    public function getAvis_image()
    {
        return $this->avis_image;
    }

    /**
     * Set the value of avis_image
     *
     * @return  self
     */ 
    public function setAvis_image($avis_image)
    {
        $this->avis_image = $avis_image;

        return $this;
    }
}
