<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=OfferRepository::class)
 */
class Offer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="offers")
     */
    private $employer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="offers")
     */
    private $tags;

    /**
     * @ORM\ManyToOne(targetEntity=Application::class, inversedBy="offer")
     */
    private $applications;

    /**
     * @ORM\ManyToOne(targetEntity=Report::class, inversedBy="offer")
     */
    private $reports;

    public function __construct()
    {
        $this->employer = new ArrayCollection();
        $this->tags = new ArrayCollection();
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

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getEmployer(): Collection
    {
        return $this->employer;
    }

    public function addEmployer(User $employer): self
    {
        if (!$this->employer->contains($employer)) {
            $this->employer[] = $employer;
            $employer->setOffers($this);
        }

        return $this;
    }

    public function removeEmployer(User $employer): self
    {
        if ($this->employer->contains($employer)) {
            $this->employer->removeElement($employer);
            // set the owning side to null (unless already changed)
            if ($employer->getOffers() === $this) {
                $employer->setOffers(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }

        return $this;
    }

    public function getApplications(): ?Application
    {
        return $this->applications;
    }

    public function setApplications(?Application $applications): self
    {
        $this->applications = $applications;

        return $this;
    }

    public function getReports(): ?Report
    {
        return $this->reports;
    }

    public function setReports(?Report $reports): self
    {
        $this->reports = $reports;

        return $this;
    }
}
