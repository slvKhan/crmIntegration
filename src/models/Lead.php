<?php

namespace App\models;

class Lead
{
    private $leads;

    public function __construct(array $leads)
    {
        $this->leads = $leads['_embedded']['items'];
    }

    public function all()
    {
        return $this->leads;
    }

    public function filter(callable $fn)
    {
        $this->leads = array_filter($this->leads, $fn);
        return $this;
    }

    public function map(callable $fn)
    {
        $this->leads = array_map($fn, $this->leads);
        return $this;
    }
}
