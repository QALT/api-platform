<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\TimestampableTrait;
use App\Repository\ApplicationRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"application:read"}},
 *      denormalizationContext={"groups"={"application:write"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={"offer.employer.id": "exact", "applicant.id": "exact"})
 * @ORM\Entity(repositoryClass=ApplicationRepository::class)
 */
class Application
{
    use TimestampableTrait;

    const SUBMITTED = "submitted";
    const ACCEPTED = "accepted";
    const REFUSED = "refused";

    const STATUS = [
        self::SUBMITTED,
        self::ACCEPTED,
        self::REFUSED
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"offer:read", "offer:write","application:write","application:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, options={"default": "submitted"})
     * @Assert\Choice(choices=Application::STATUS)
     * @Groups({"offer:read", "offer:write","application:write","application:read"})
     */
    private $status = self::SUBMITTED;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"offer:read", "offer:write","application:write","application:read"})
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity=Offer::class, inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"application:write","application:read"})
     */
    private $offer;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"application:write","application:read"})
     */
    private $applicant;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    public function setOffer(?Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    public function getApplicant(): ?User
    {
        return $this->applicant;
    }

    public function setApplicant(?User $applicant): self
    {
        $this->applicant = $applicant;

        return $this;
    }
}
