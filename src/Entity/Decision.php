<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DecisionRepository")
 */
class Decision
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
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $allowedAt;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isTaken;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Document", mappedBy="decision")
     */
    private $documents;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contributor", mappedBy="decision")
     */
    private $contributors;

    public function __construct()
    {
        $this->documents = new ArrayCollection();
        $this->contributors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getAllowedAt(): ?\DateTimeInterface
    {
        return $this->allowedAt;
    }

    public function setAllowedAt(\DateTimeInterface $allowedAt): self
    {
        $this->allowedAt = $allowedAt;

        return $this;
    }

    public function getIsTaken(): ?bool
    {
        return $this->isTaken;
    }

    public function setIsTaken(?bool $isTaken): self
    {
        $this->isTaken = $isTaken;

        return $this;
    }

    /**
     * @return Collection|Document[]
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents[] = $document;
            $document->setDecision($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->documents->contains($document)) {
            $this->documents->removeElement($document);
            // set the owning side to null (unless already changed)
            if ($document->getDecision() === $this) {
                $document->setDecision(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contributor[]
     */
    public function getContributors(): Collection
    {
        return $this->contributors;
    }

    public function addContributor(Contributor $contributor): self
    {
        if (!$this->contributors->contains($contributor)) {
            $this->contributors[] = $contributor;
            $contributor->setDecision($this);
        }

        return $this;
    }

    public function removeContributor(Contributor $contributor): self
    {
        if ($this->contributors->contains($contributor)) {
            $this->contributors->removeElement($contributor);
            // set the owning side to null (unless already changed)
            if ($contributor->getDecision() === $this) {
                $contributor->setDecision(null);
            }
        }

        return $this;
    }

}
