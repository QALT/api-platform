<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Traits\TimestampableTrait;
use App\Repository\StudyRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  normalizationContext={"groups"={"study:read"}},
 *  denormalizationContext={"groups"={"study:write"}}
 * )
 * @ORM\Entity(repositoryClass=StudyRepository::class)
 */
class Study
{
    use TimestampableTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user:read","study:write","study:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read","study:write","study:read"})
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read","study:write","study:read"})
     */
    private $school;

    /**
     * @ORM\ManyToOne(targetEntity=Degree::class, inversedBy="studies")
     * @Groups({"user:read","study:write","study:read"})
     */
    private $degree;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="studies")
     * @Groups({"study:write","study:read"})
     */
    private $userAccount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getSchool(): ?string
    {
        return $this->school;
    }

    public function setSchool(string $school): self
    {
        $this->school = $school;

        return $this;
    }

    public function getDegree(): ?Degree
    {
        return $this->degree;
    }

    public function setDegree(?Degree $degree): self
    {
        $this->degree = $degree;

        return $this;
    }

    public function getUseraccount(): ?User
    {
        return $this->userAccount;
    }

    public function setUseraccount(?User $userAccount): self
    {
        $this->userAccount = $userAccount;

        return $this;
    }
}
