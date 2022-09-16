<?php


namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(type: 'string')]
    private string $password;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $username;


    #[ORM\Column(type: 'string', length: 255)]
    private ?string $specialization;

    #[ORM\Column(type: 'integer')]
    private ?int $inami_number;

    #[ORM\OneToOne(inversedBy: 'user', targetEntity: Photo::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Photo $photo;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $job;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: HourlyRequest::class)]
    private $hourlyRequests;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: AdminMessage::class)]
    private Collection $adminMessages;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: DeleteMessage::class)]
    private $deleteMessages;

    #[ORM\ManyToMany(targetEntity: Hourly::class, mappedBy: 'favoris')]
    private $favoris;

    #[ORM\ManyToMany(targetEntity: AdminMessage::class, mappedBy: 'textChange')]
    private $textChange;


    #[Pure] public function __construct()
    {
        $this->hourlyRequests = new ArrayCollection();
        $this->adminMessages = new ArrayCollection();
        $this->deleteMessages = new ArrayCollection();
        $this->favoris = new ArrayCollection();
        $this->textChange = new ArrayCollection();
    }


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
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
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
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getSpecialization(): ?string
    {
        return $this->specialization;
    }

    public function setSpecialization(string $specialization): self
    {
        $this->specialization = $specialization;

        return $this;
    }

    public function getInamiNumber(): ?int
    {
        return $this->inami_number;
    }

    public function setInamiNumber(int $inami_number): self
    {
        $this->inami_number = $inami_number;

        return $this;
    }

    public function getPhoto(): ?Photo
    {
        return $this->photo;
    }

    public function setPhoto(Photo $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(string $job): self
    {
        $this->job = $job;

        return $this;
    }

    /**
     * @return Collection<int, HourlyRequest>
     */
    public function getHourlyRequests(): Collection
    {
        return $this->hourlyRequests;
    }

    public function addHourlyRequest(HourlyRequest $hourlyRequest): self
    {
        if (!$this->hourlyRequests->contains($hourlyRequest)) {
            $this->hourlyRequests[] = $hourlyRequest;
            $hourlyRequest->setUser($this);
        }

        return $this;
    }

    public function removeHourlyRequest(HourlyRequest $hourlyRequest): self
    {
        if ($this->hourlyRequests->removeElement($hourlyRequest)) {
            // set the owning side to null (unless already changed)
            if ($hourlyRequest->getUser() === $this) {
                $hourlyRequest->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AdminMessage>
     */
    public function getAdminMessages(): Collection
    {
        return $this->adminMessages;
    }

    public function addAdminMessage(AdminMessage $adminMessage): self
    {
        if (!$this->adminMessages->contains($adminMessage)) {
            $this->adminMessages[] = $adminMessage;
            $adminMessage->setUser($this);
        }

        return $this;
    }

    public function removeAdminMessage(AdminMessage $adminMessage): self
    {
        if ($this->adminMessages->removeElement($adminMessage)) {
            // set the owning side to null (unless already changed)
            if ($adminMessage->getUser() === $this) {
                $adminMessage->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DeleteMessage>
     */
    public function getDeleteMessages(): Collection
    {
        return $this->deleteMessages;
    }

    public function addDeleteMessage(DeleteMessage $deleteMessage): self
    {
        if (!$this->deleteMessages->contains($deleteMessage)) {
            $this->deleteMessages[] = $deleteMessage;
            $deleteMessage->setAuthor($this);
        }

        return $this;
    }

    public function removeDeleteMessage(DeleteMessage $deleteMessage): self
    {
        if ($this->deleteMessages->removeElement($deleteMessage)) {
            // set the owning side to null (unless already changed)
            if ($deleteMessage->getAuthor() === $this) {
                $deleteMessage->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Hourly>
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Hourly $favori): self
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris[] = $favori;
            $favori->addFavori($this);
        }

        return $this;
    }

    public function removeFavori(Hourly $favori): self
    {
        if ($this->favoris->removeElement($favori)) {
            $favori->removeFavori($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, AdminMessage>
     */
    public function getTextChange(): Collection
    {
        return $this->textChange;
    }

    public function addTextChange(AdminMessage $textChange): self
    {
        if (!$this->textChange->contains($textChange)) {
            $this->textChange[] = $textChange;
            $textChange->addTextChange($this);
        }

        return $this;
    }

    public function removeTextChange(AdminMessage $textChange): self
    {
        if ($this->textChange->removeElement($textChange)) {
            $textChange->removeTextChange($this);
        }

        return $this;
    }

}

