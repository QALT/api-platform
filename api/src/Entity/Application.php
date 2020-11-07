<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ApplicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ApplicationRepository::class)
 */
class Application
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Offer::class, mappedBy="applications")
     */
    private $offer;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="applications")
     */
    private $applicant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $customComment;

    public function __construct()
    {
        $this->offer = new ArrayCollection();
        $this->applicant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Offer[]
     */
    public function getOffer(): Collection
    {
        return $this->offer;
    }

    public function addOffer(Offer $offer): self
    {
        if (!$this->offer->contains($offer)) {
            $this->offer[] = $offer;
            $offer->setApplications($this);
        }

        return $this;
    }

    public function removeOffer(Offer $offer): self
    {
        if ($this->offer->contains($offer)) {
            $this->offer->removeElement($offer);
            // set the owning side to null (unless already changed)
            if ($offer->getApplications() === $this) {
                $offer->setApplications(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getApplicant(): Collection
    {
        return $this->applicant;
    }

    public function addApplicant(User $applicant): self
    {
        if (!$this->applicant->contains($applicant)) {
            $this->applicant[] = $applicant;
            $applicant->setApplications($this);
        }

        return $this;
    }

    public function removeApplicant(User $applicant): self
    {
        if ($this->applicant->contains($applicant)) {
            $this->applicant->removeElement($applicant);
            // set the owning side to null (unless already changed)
            if ($applicant->getApplications() === $this) {
                $applicant->setApplications(null);
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

    public function getCustomComment(): ?string
    {
        return $this->customComment;
    }

    public function setCustomComment(?string $customComment): self
    {
        $this->customComment = $customComment;

        return $this;
    }
}
