<?php

namespace App\Twig;

use App\Search\Admin\HourlyAdminSearchFormGenerator;
use App\Search\Admin\SearchUserFormGenerator;
use App\Search\User\HourlySearchFormGenerator;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MyTwigExtension extends AbstractExtension
{

    private SearchUserFormGenerator $searchUserFormGenerator;
    private HourlySearchFormGenerator $hourlySearchFormGenerator;
    private HourlyAdminSearchFormGenerator $hourlyAdminSearchFormGenerator;

    /**
     * @param SearchUserFormGenerator $searchUserFormGenerator
     * @param HourlySearchFormGenerator $hourlySearchFormGenerator
     * @param HourlyAdminSearchFormGenerator $hourlyAdminSearchFormGenerator
     */
    public function __construct(SearchUserFormGenerator $searchUserFormGenerator, HourlySearchFormGenerator $hourlySearchFormGenerator, HourlyAdminSearchFormGenerator $hourlyAdminSearchFormGenerator)
    {
        $this->searchUserFormGenerator = $searchUserFormGenerator;
        $this->hourlySearchFormGenerator = $hourlySearchFormGenerator;
        $this->hourlyAdminSearchFormGenerator = $hourlyAdminSearchFormGenerator;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getSearchUserForm', [$this->searchUserFormGenerator,'getSearchUserForm']),
            new TwigFunction('getHourlySearchForm', [$this->hourlySearchFormGenerator, 'getHourlySearchForm']),
            new TwigFunction('getHourlyAdminSearchForm', [$this->hourlyAdminSearchFormGenerator, 'getHourlyAdminSearchForm'] )
        ];
    }


}