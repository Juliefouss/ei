<?php

namespace App\Entity;

use App\Repository\AdminMessageRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Blameable;

#[ORM\Entity(repositoryClass: AdminMessageRepository::class)]
class AdminMessage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Blameable (on: 'create')]
    private ?string $name;

    #[ORM\Column(type: 'string', length: 255)]
    #[Blameable (on: 'create')]
    private ?string $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Blameable (on: 'create')]
    private ?string $email;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $message;

    #[ORM\Column(type: 'string', length: 255)]
    private $subject;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'adminMessages')]
    #[ORM\JoinColumn(nullable: false)]
    #[Blameable (on: 'create')]
    private $User;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }


}
