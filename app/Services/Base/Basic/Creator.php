<?php


namespace App\Services\Base\Basic;


use Illuminate\Http\Request;

interface Creator
{
    public function store(Request $request);
}
