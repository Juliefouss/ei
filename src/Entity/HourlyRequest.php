<?php

namespace App\Entity;

use App\Repository\HourlyRequestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Blameable;

#[ORM\Entity(repositoryClass: HourlyRequestRepository::class)]
class HourlyRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $date;

    #[ORM\Column(type: 'string', length: 255)]
    private $hour;

    #[ORM\ManyToOne(targetEntity: Service::class, inversedBy: 'hourlyRequests')]
    #[ORM\JoinColumn(nullable: false)]
    private $service;


    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'hourlyRequests')]
    #[ORM\JoinColumn(nullable: false)]
    #[Blameable (on: 'create')]
    private $user;

    #[ORM\OneToMany(mappedBy: 'HourlyRequest', targetEntity: Hourly::class)]
    private $hourlies;

    public function __construct()
    {
        $this->hourlies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHour(): ?string
    {
        return $this->hour;
    }

    public function setHour(string $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }
    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Hourly>
     */
    public function getHourlies(): Collection
    {
        return $this->hourlies;
    }

    public function addHourly(Hourly $hourly): self
    {
        if (!$this->hourlies->contains($hourly)) {
            $this->hourlies[] = $hourly;
            $hourly->setHourlyRequest($this);
        }

        return $this;
    }

    public function removeHourly(Hourly $hourly): self
    {
        if ($this->hourlies->removeElement($hourly)) {
            // set the owning side to null (unless already changed)
            if ($hourly->getHourlyRequest() === $this) {
                $hourly->setHourlyRequest(null);
            }
        }

        return $this;
    }
}
