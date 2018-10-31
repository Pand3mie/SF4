<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 */
class Tag
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\BlogPost", inversedBy="blogTags")
     */
    private $tagsBlog;

    public function __construct()
    {
        $this->tagsBlog = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    /**
     * @return Collection|BlogPost[]
     */
    public function getTagsBlog(): Collection
    {
        return $this->tagsBlog;
    }

    public function addTagsBlog(BlogPost $tagsBlog): self
    {
        if (!$this->tagsBlog->contains($tagsBlog)) {
            $this->tagsBlog[] = $tagsBlog;
        }

        return $this;
    }

    public function removeTagsBlog(BlogPost $tagsBlog): self
    {
        if ($this->tagsBlog->contains($tagsBlog)) {
            $this->tagsBlog->removeElement($tagsBlog);
        }

        return $this;
    }
}
