<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PresentationPageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PresentationPageRepository::class)
 */
class PresentationPage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="json")
     */
    private $content = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="presentationPage", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $userAccount;

    /**
     * @ORM\ManyToOne(targetEntity=Report::class, inversedBy="presentationPage")
     */
    private $reports;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?array
    {
        return $this->content;
    }

    public function setContent(array $content): self
    {
        $this->content = $content;

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

    public function getUserAccount(): ?User
    {
        return $this->userAccount;
    }

    public function setUserAccount(User $userAccount): self
    {
        $this->userAccount = $userAccount;

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
