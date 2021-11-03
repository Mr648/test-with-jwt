<?php


namespace App\Services\Base\Basic;


use Illuminate\Http\Request;

interface Presenter
{
    public function list(Request $request);

    public function show(Request $request, $id);
}
