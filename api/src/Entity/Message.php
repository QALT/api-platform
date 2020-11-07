<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="sendMessages")
     */
    private $sender;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="receivedMessages")
     */
    private $receiver;

    public function __construct()
    {
        $this->sender = new ArrayCollection();
        $this->receiver = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getSender(): Collection
    {
        return $this->sender;
    }

    public function addSender(User $sender): self
    {
        if (!$this->sender->contains($sender)) {
            $this->sender[] = $sender;
            $sender->setSendMessages($this);
        }

        return $this;
    }

    public function removeSender(User $sender): self
    {
        if ($this->sender->contains($sender)) {
            $this->sender->removeElement($sender);
            // set the owning side to null (unless already changed)
            if ($sender->getSendMessages() === $this) {
                $sender->setSendMessages(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getReceiver(): Collection
    {
        return $this->receiver;
    }

    public function addReceiver(User $receiver): self
    {
        if (!$this->receiver->contains($receiver)) {
            $this->receiver[] = $receiver;
            $receiver->setReceivedMessages($this);
        }

        return $this;
    }

    public function removeReceiver(User $receiver): self
    {
        if ($this->receiver->contains($receiver)) {
            $this->receiver->removeElement($receiver);
            // set the owning side to null (unless already changed)
            if ($receiver->getReceivedMessages() === $this) {
                $receiver->setReceivedMessages(null);
            }
        }

        return $this;
    }
}
