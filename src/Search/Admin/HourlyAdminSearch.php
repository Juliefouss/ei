<?php

namespace App\Search\Admin;

class HourlyAdminSearch
{
    private mixed $number;
    private mixed $services;
    private mixed $hospitals;

    /**
     * @return mixed
     */
    public function getNumber(): mixed
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber(mixed $number): void
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getServices(): mixed
    {
        return $this->services;
    }

    /**
     * @param mixed $services
     */
    public function setServices(mixed $services): void
    {
        $this->services = $services;
    }

    /**
     * @return mixed
     */
    public function getHospitals(): mixed
    {
        return $this->hospitals;
    }

    /**
     * @param mixed $hospitals
     */
    public function setHospitals(mixed $hospitals): void
    {
        $this->hospitals = $hospitals;
    }



}