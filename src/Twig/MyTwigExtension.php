<?php

namespace App\Twig;

use App\Search\Admin\SearchUserFormGenerator;
use App\Search\User\HourlySearchFormGenerator;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MyTwigExtension extends AbstractExtension
{

    private SearchUserFormGenerator $searchUserFormGenerator;
    private HourlySearchFormGenerator $hourlySearchFormGenerator;

    /**
     * @param SearchUserFormGenerator $searchUserFormGenerator
     * @param HourlySearchFormGenerator $hourlySearchFormGenerator
     */
    public function __construct(SearchUserFormGenerator $searchUserFormGenerator, HourlySearchFormGenerator $hourlySearchFormGenerator)
    {
        $this->searchUserFormGenerator = $searchUserFormGenerator;
        $this->hourlySearchFormGenerator = $hourlySearchFormGenerator;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getSearchUserForm', [$this->searchUserFormGenerator,'getSearchUserForm']),
            new TwigFunction('getHourlySearchForm', [$this->hourlySearchFormGenerator, 'getHourlySearchForm'])
        ];
    }


}