<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'Service', targetEntity: Hourly::class)]
    private $hourlies;

    #[ORM\OneToMany(mappedBy: 'service', targetEntity: HourlyRequest::class)]
    private $hourlyRequests;

    public function __construct()
    {
        $this->hourlies = new ArrayCollection();
        $this->hourlyRequests = new ArrayCollection();
    }

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
            $hourly->setService($this);
        }

        return $this;
    }

    public function removeHourly(Hourly $hourly): self
    {
        if ($this->hourlies->removeElement($hourly)) {
            // set the owning side to null (unless already changed)
            if ($hourly->getService() === $this) {
                $hourly->setService(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        return $this->name;
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
            $hourlyRequest->setService($this);
        }

        return $this;
    }

    public function removeHourlyRequest(HourlyRequest $hourlyRequest): self
    {
        if ($this->hourlyRequests->removeElement($hourlyRequest)) {
            // set the owning side to null (unless already changed)
            if ($hourlyRequest->getService() === $this) {
                $hourlyRequest->setService(null);
            }
        }

        return $this;
    }

}
