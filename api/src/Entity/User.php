<?php

namespace App\Entity;

use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`useraccount`")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToOne(targetEntity=Address::class, inversedBy="userAccount", cascade={"persist", "remove"})
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity=Report::class, inversedBy="reporter")
     */
    private $reports;

    /**
     * @ORM\ManyToOne(targetEntity=Report::class, inversedBy="userReported")
     */
    private $reportMentioned;

    /**
     * @ORM\OneToOne(targetEntity=PresentationPage::class, mappedBy="userAccount", cascade={"persist", "remove"})
     */
    private $presentationPage;

    /**
     * @ORM\ManyToOne(targetEntity=Offer::class, inversedBy="employer")
     */
    private $offers;

    /**
     * @ORM\ManyToOne(targetEntity=Application::class, inversedBy="applicant")
     */
    private $applications;

    /**
     * @ORM\ManyToOne(targetEntity=Message::class, inversedBy="sender")
     */
    private $sendMessages;

    /**
     * @ORM\ManyToOne(targetEntity=Message::class, inversedBy="receiver")
     */
    private $receivedMessages;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="date")
     */
    private $birthday;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

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

    public function getReportMentioned(): ?Report
    {
        return $this->reportMentioned;
    }

    public function setReportMentioned(?Report $reportMentioned): self
    {
        $this->reportMentioned = $reportMentioned;

        return $this;
    }

    public function getPresentationPage(): ?PresentationPage
    {
        return $this->presentationPage;
    }

    public function setPresentationPage(PresentationPage $presentationPage): self
    {
        $this->presentationPage = $presentationPage;

        // set the owning side of the relation if necessary
        if ($presentationPage->getUserAccount() !== $this) {
            $presentationPage->setUserAccount($this);
        }

        return $this;
    }

    public function getOffers(): ?Offer
    {
        return $this->offers;
    }

    public function setOffers(?Offer $offers): self
    {
        $this->offers = $offers;

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

    public function getSendMessages(): ?Message
    {
        return $this->sendMessages;
    }

    public function setSendMessages(?Message $sendMessages): self
    {
        $this->sendMessages = $sendMessages;

        return $this;
    }

    public function getReceivedMessages(): ?Message
    {
        return $this->receivedMessages;
    }

    public function setReceivedMessages(?Message $receivedMessages): self
    {
        $this->receivedMessages = $receivedMessages;

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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }
}
