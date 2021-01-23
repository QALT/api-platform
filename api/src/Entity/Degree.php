<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\DegreeRepository;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=DegreeRepository::class)
 */
class Degree
{
    use TimestampableTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"study:write","study:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"study:write","study:read"})
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity=Study::class, mappedBy="degree")
     */
    private $studies;

    public function __construct()
    {
        $this->studies = new ArrayCollection();
    }

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

    /**
     * @return Collection|Study[]
     */
    public function getStudies(): Collection
    {
        return $this->studies;
    }

    public function addStudy(Study $study): self
    {
        if (!$this->studies->contains($study)) {
            $this->studies[] = $study;
            $study->setDegree($this);
        }

        return $this;
    }

    public function removeStudy(Study $study): self
    {
        if ($this->studies->contains($study)) {
            $this->studies->removeElement($study);
            // set the owning side to null (unless already changed)
            if ($study->getDegree() === $this) {
                $study->setDegree(null);
            }
        }

        return $this;
    }
}
