<?php


namespace App\Traits;


use App\Models\User;

trait Administrator
{
    public function getAdministrator()
    {
        return User::query()->firstOrFail(['email' => 'admin@site.com']);
    }
}
