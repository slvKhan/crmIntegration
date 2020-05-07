<?php

namespace App\models;

class Lead
{
    private $leads;

    public function __construct(array $leads)
    {
        $this->leads = $leads['_embedded']['items'];
    }

    public function all(): array
    {
        return $this->leads;
    }

    public function filter(callable $fn): object
    {
        $this->leads = array_filter($this->leads, $fn);
        return $this;
    }

    public function map(callable $fn): object
    {
        $this->leads = array_map($fn, $this->leads);
        return $this;
    }
}
