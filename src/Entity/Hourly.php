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




}
