<?php

namespace App\Twig;

use App\Search\Admin\HourlyAdminSearchFormGenerator;
use App\Search\Admin\SearchUserFormGenerator;
use App\Search\Hospital\HourlyHospitalSearchFormGenerator;
use App\Search\User\HourlySearchFormGenerator;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MyTwigExtension extends AbstractExtension
{

    private SearchUserFormGenerator $searchUserFormGenerator;
    private HourlySearchFormGenerator $hourlySearchFormGenerator;
    private HourlyAdminSearchFormGenerator $hourlyAdminSearchFormGenerator;
    private HourlyHospitalSearchFormGenerator $hourlyHospitalSearchFormGenerator;

    /**
     * @param SearchUserFormGenerator $searchUserFormGenerator
     * @param HourlySearchFormGenerator $hourlySearchFormGenerator
     * @param HourlyAdminSearchFormGenerator $hourlyAdminSearchFormGenerator
     * @param HourlyHospitalSearchFormGenerator $hourlyHospitalSearchFormGenerator
     */
    public function __construct(SearchUserFormGenerator $searchUserFormGenerator, HourlySearchFormGenerator $hourlySearchFormGenerator, HourlyAdminSearchFormGenerator $hourlyAdminSearchFormGenerator, HourlyHospitalSearchFormGenerator $hourlyHospitalSearchFormGenerator)
    {
        $this->searchUserFormGenerator = $searchUserFormGenerator;
        $this->hourlySearchFormGenerator = $hourlySearchFormGenerator;
        $this->hourlyAdminSearchFormGenerator = $hourlyAdminSearchFormGenerator;
        $this->hourlyHospitalSearchFormGenerator = $hourlyHospitalSearchFormGenerator;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getSearchUserForm', [$this->searchUserFormGenerator,'getSearchUserForm']),
            new TwigFunction('getHourlySearchForm', [$this->hourlySearchFormGenerator, 'getHourlySearchForm']),
            new TwigFunction('getHourlyAdminSearchForm', [$this->hourlyAdminSearchFormGenerator, 'getHourlyAdminSearchForm'] ),
            new TwigFunction('getHourlyHospitalSearchForm', [$this->hourlyHospitalSearchFormGenerator, 'getHourlyHospitalSearchForm'])
        ];
    }


}