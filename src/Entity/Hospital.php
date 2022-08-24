<?php

namespace App\Entity;

use App\Repository\HospitalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HospitalRepository::class)]
class Hospital
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'Hospital', targetEntity: Hourly::class)]
    private $hourlies;

    public function __construct()
    {
        $this->hourlies = new ArrayCollection();
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
            $hourly->setHospital($this);
        }

        return $this;
    }

    public function removeHourly(Hourly $hourly): self
    {
        if ($this->hourlies->removeElement($hourly)) {
            // set the owning side to null (unless already changed)
            if ($hourly->getHospital() === $this) {
                $hourly->setHospital(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        return $this->name;
    }

}
