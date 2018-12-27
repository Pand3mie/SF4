<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ResponseRepository")
 */
class Response
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
    private $fromResponse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $toResponse;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $bodyResponse;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Avis", inversedBy="responses")
     */
    private $idAvis;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromResponse(): ?string
    {
        return $this->fromResponse;
    }

    public function setFromResponse(string $fromResponse): self
    {
        $this->fromResponse = $fromResponse;

        return $this;
    }

    public function getToResponse(): ?string
    {
        return $this->toResponse;
    }

    public function setToResponse(string $toResponse): self
    {
        $this->toResponse = $toResponse;

        return $this;
    }

    public function getBodyResponse(): ?string
    {
        return $this->bodyResponse;
    }

    public function setBodyResponse(?string $bodyResponse): self
    {
        $this->bodyResponse = $bodyResponse;

        return $this;
    }

    public function getIdAvis(): ?Avis
    {
        return $this->idAvis;
    }

    public function setIdAvis(?Avis $idAvis): self
    {
        $this->idAvis = $idAvis;

        return $this;
    }
}
