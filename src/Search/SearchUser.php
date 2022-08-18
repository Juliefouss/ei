<?php

namespace App\Search;

class SearchUser
{

    private string $keyword;
    private string $specializations;

    /**
     * @return string
     */
    public function getKeyword(): string
    {
        return $this->keyword;
    }

    /**
     * @param string $keyword
     */
    public function setKeyword(string $keyword): void
    {
        $this->keyword = $keyword;
    }

    /**
     * @return string
     */
    public function getSpecializations(): string
    {
        return $this->specializations;
    }

    /**
     * @param string $specializations
     */
    public function setSpecializations(string $specializations): void
    {
        $this->specializations = $specializations;
    }


}