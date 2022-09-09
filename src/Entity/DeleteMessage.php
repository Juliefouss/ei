<?php

namespace App\Entity;

use App\Repository\DeleteMessageRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Blameable;

#[ORM\Entity(repositoryClass: DeleteMessageRepository::class)]
class DeleteMessage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'deleteMessages')]
    #[ORM\JoinColumn(nullable: false)]
    #[Blameable(on: 'create')]
    private $author;

    #[ORM\Column(type: 'integer')]
    private $HourlyId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getHourlyId(): ?int
    {
        return $this->HourlyId;
    }

    public function setHourlyId(int $HourlyId): self
    {
        $this->HourlyId = $HourlyId;

        return $this;
    }
}
