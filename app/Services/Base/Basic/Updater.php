<?php


namespace App\Services\Base\Basic;


use Illuminate\Http\Request;

interface Updater
{
    public function update(Request $request, $id);
}
