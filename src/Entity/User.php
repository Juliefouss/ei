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

    #[ORM\Column(type: 'integer')]
    private $inamiNumberPart1;

    #[ORM\Column(type: 'integer')]
    private $inamiNumberPart2;

    #[ORM\Column(type: 'integer')]
    private $inamiNumberPart3;

    #[ORM\Column(type: 'integer')]
    private $inamiNumberPart4;



    #[Pure] public function __construct()
    {
        $this->hourlyRequests = new ArrayCollection();
        $this->adminMessages = new ArrayCollection();
        $this->deleteMessages = new ArrayCollection();
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

    public function getInamiNumberPart1(): ?int
    {
        return $this->inamiNumberPart1;
    }

    public function setInamiNumberPart1(int $inamiNumberPart1): self
    {
        $this->inamiNumberPart1 = $inamiNumberPart1;

        return $this;
    }

    public function getInamiNumberPart2(): ?int
    {
        return $this->inamiNumberPart2;
    }

    public function setInamiNumberPart2(int $inamiNumberPart2): self
    {
        $this->inamiNumberPart2 = $inamiNumberPart2;

        return $this;
    }

    public function getInamiNumberPart3(): ?int
    {
        return $this->inamiNumberPart3;
    }

    public function setInamiNumberPart3(int $inamiNumberPart3): self
    {
        $this->inamiNumberPart3 = $inamiNumberPart3;

        return $this;
    }

    public function getInamiNumberPart4(): ?int
    {
        return $this->inamiNumberPart4;
    }

    public function setInamiNumberPart4(int $inamiNumberPart4): self
    {
        $this->inamiNumberPart4 = $inamiNumberPart4;

        return $this;
    }


}

