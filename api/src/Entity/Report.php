<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ReportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ReportRepository::class)
 */
class Report
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $motivation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="reports")
     */
    private $reporter;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="reportMentioned")
     */
    private $userReported;

    /**
     * @ORM\OneToMany(targetEntity=Offer::class, mappedBy="reports")
     */
    private $offer;

    /**
     * @ORM\OneToMany(targetEntity=PresentationPage::class, mappedBy="reports")
     */
    private $presentationPage;

    public function __construct()
    {
        $this->reporter = new ArrayCollection();
        $this->userReported = new ArrayCollection();
        $this->offer = new ArrayCollection();
        $this->presentationPage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotivation(): ?string
    {
        return $this->motivation;
    }

    public function setMotivation(?string $motivation): self
    {
        $this->motivation = $motivation;

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
     * @return Collection|User[]
     */
    public function getReporter(): Collection
    {
        return $this->reporter;
    }

    public function addReporter(User $reporter): self
    {
        if (!$this->reporter->contains($reporter)) {
            $this->reporter[] = $reporter;
            $reporter->setReports($this);
        }

        return $this;
    }

    public function removeReporter(User $reporter): self
    {
        if ($this->reporter->contains($reporter)) {
            $this->reporter->removeElement($reporter);
            // set the owning side to null (unless already changed)
            if ($reporter->getReports() === $this) {
                $reporter->setReports(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUserReported(): Collection
    {
        return $this->userReported;
    }

    public function addUserReported(User $userReported): self
    {
        if (!$this->userReported->contains($userReported)) {
            $this->userReported[] = $userReported;
            $userReported->setReportMentioned($this);
        }

        return $this;
    }

    public function removeUserReported(User $userReported): self
    {
        if ($this->userReported->contains($userReported)) {
            $this->userReported->removeElement($userReported);
            // set the owning side to null (unless already changed)
            if ($userReported->getReportMentioned() === $this) {
                $userReported->setReportMentioned(null);
            }
        }

        return $this;
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
            $offer->setReports($this);
        }

        return $this;
    }

    public function removeOffer(Offer $offer): self
    {
        if ($this->offer->contains($offer)) {
            $this->offer->removeElement($offer);
            // set the owning side to null (unless already changed)
            if ($offer->getReports() === $this) {
                $offer->setReports(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PresentationPage[]
     */
    public function getPresentationPage(): Collection
    {
        return $this->presentationPage;
    }

    public function addPresentationPage(PresentationPage $presentationPage): self
    {
        if (!$this->presentationPage->contains($presentationPage)) {
            $this->presentationPage[] = $presentationPage;
            $presentationPage->setReports($this);
        }

        return $this;
    }

    public function removePresentationPage(PresentationPage $presentationPage): self
    {
        if ($this->presentationPage->contains($presentationPage)) {
            $this->presentationPage->removeElement($presentationPage);
            // set the owning side to null (unless already changed)
            if ($presentationPage->getReports() === $this) {
                $presentationPage->setReports(null);
            }
        }

        return $this;
    }
}
