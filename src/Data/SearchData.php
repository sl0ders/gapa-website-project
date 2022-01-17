<?php

namespace App\Data;


use phpDocumentor\Reflection\Types\Boolean;

class SearchData
{
    public int $page = 1;

    /** @var null|string  */
    public ?string $q = '';

    /**
     * @var array
     */
    public array $categories = [];

    /**
     * @var Boolean
     */
    public $promo = false;

    /**
     * @return null|string
     */
    public function getQ(): ?string
    {
        return $this->q;
    }

    /**
     * @param null|string $q
     */
    public function setQ(?string $q): void
    {
        $this->q = $q;
    }
}