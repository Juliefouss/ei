<?php

namespace App\Entity;

use App\Repository\HourlyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Blameable;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: HourlyRepository::class)]
class Hourly
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $date;

    #[ORM\Column(type: 'string', length: 255)]
    private $hour;

    #[ORM\ManyToOne(targetEntity: Service::class, inversedBy: 'hourlies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Service $Service;

    #[ORM\ManyToOne(targetEntity: Hospital::class, inversedBy: 'hourlies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hospital $Hospital;

    #[ORM\ManyToOne(targetEntity: HourlyRequest::class, inversedBy: 'hourlies')]
    private ?HourlyRequest $HourlyRequest;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'favoris')]
    private $favoris;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'favoris')]
    private $options;

    public function __construct()
    {
        $this->favoris = new ArrayCollection();
        $this->options = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * @param mixed $hour
     */
    public function setHour($hour): void
    {
        $this->hour = $hour;
    }

    public function getService(): ?Service
    {
        return $this->Service;
    }

    public function setService(?Service $Service): self
    {
        $this->Service = $Service;

        return $this;
    }

    public function getHospital(): ?Hospital
    {
        return $this->Hospital;
    }

    public function setHospital(?Hospital $Hospital): self
    {
        $this->Hospital = $Hospital;

        return $this;
    }

    public function getHourlyRequest(): ?HourlyRequest
    {
        return $this->HourlyRequest;
    }

    public function setHourlyRequest(?HourlyRequest $HourlyRequest): self
    {
        $this->HourlyRequest = $HourlyRequest;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(User $favori): self
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris[] = $favori;
        }

        return $this;
    }

    public function removeFavori(User $favori): self
    {
        $this->favoris->removeElement($favori);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(User $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
        }

        return $this;
    }

    public function removeOption(User $option): self
    {
        $this->favoris->removeElement($option);

        return $this;
    }




}
