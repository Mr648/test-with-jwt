<?php


namespace App\Services\Base\Basic;


class BasicService
{
    public $model;

    public function __construct(string $class)
    {
        $this->model = $class;
    }
}
