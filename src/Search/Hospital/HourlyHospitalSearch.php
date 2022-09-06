<?php

namespace App\Search\Hospital;

class HourlyHospitalSearch
{

    private mixed $services;
    private mixed $hospitals;

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