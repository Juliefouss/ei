<?php

namespace App\Twig;

use App\Search\Admin\SearchUsersFormGenerator;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MyTwigExtension extends AbstractExtension
{

    private SearchUsersFormGenerator $searchFormGenerator;

    /**
     * @param SearchUsersFormGenerator $searchFormGenerator
     */
    public function __construct(SearchUsersFormGenerator $searchFormGenerator)
    {
        $this->searchFormGenerator = $searchFormGenerator;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getSearchForm', [$this->searchFormGenerator,'getSearchForm'])
        ];
    }


}