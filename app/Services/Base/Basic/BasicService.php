<?php


namespace App\Services\Base\Basic;


class BasicService
{
    public $model;

    public function __construct(string $class)
    {
        $this->model = $class;
    }

    public function getBaseQuery($with = [], $withCount=[])
    {
        return $this->model::with($with)->withCount($withCount);
    }
}
