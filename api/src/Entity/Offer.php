<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Traits\TimestampableTrait;
use App\Repository\OfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"offer:read"}},
 *      denormalizationContext={"groups"={"offer:write"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={"employer.id": "exact"})
 * @ORM\Entity(repositoryClass=OfferRepository::class)
 */
class Offer
{
    use TimestampableTrait;

    public const CREATED = "created";
    public const DELETED = "deleted";

    public const STATUS = [
        self::CREATED,
        self::DELETED
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"offer:read", "offer:write","application:write","application:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"offer:read", "offer:write","application:write","application:read"})
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Groups({"offer:read", "offer:write","application:write","application:read"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, options={"default": "created"})
     * @Assert\Choice(choices=Offer::STATUS)
     * @Groups({"offer:read", "offer:write","application:write","application:read"})
     */
    private $status = self::CREATED;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="offers", cascade={"persist"})
     * @Groups({"offer:read", "offer:write"})
     */
    private $employer;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="offers", cascade={"persist"})
     * @Groups({"offer:read", "offer:write"})
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity=Report::class, mappedBy="offer")
     * @Groups({"offer:read", "offer:write"})
     */
    private $reports;

    /**
     * @ORM\OneToMany(targetEntity=Application::class, mappedBy="offer", orphanRemoval=true)
     * @Groups({"offer:read", "offer:write"})
     */
    private $applications;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->reports = new ArrayCollection();
        $this->applications = new ArrayCollection();
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getEmployer(): ?User
    {
        return $this->employer;
    }

    public function setEmployer(?User $employer): self
    {
        $this->employer = $employer;

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

    /**
     * @return Collection|Report[]
     */
    public function getReports(): Collection
    {
        return $this->reports;
    }

    public function addReport(Report $report): self
    {
        if (!$this->reports->contains($report)) {
            $this->reports[] = $report;
            $report->setOffer($this);
        }

        return $this;
    }

    public function removeReport(Report $report): self
    {
        if ($this->reports->contains($report)) {
            $this->reports->removeElement($report);
            // set the owning side to null (unless already changed)
            if ($report->getOffer() === $this) {
                $report->setOffer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Application[]
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function addApplication(Application $application): self
    {
        if (!$this->applications->contains($application)) {
            $this->applications[] = $application;
            $application->setOffer($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->contains($application)) {
            $this->applications->removeElement($application);
            // set the owning side to null (unless already changed)
            if ($application->getOffer() === $this) {
                $application->setOffer(null);
            }
        }

        return $this;
    }
}
