<?php


namespace App\Models\Enums;


class Roles
{
    const ADMIN = 'admin';
    const AUTHOR = 'author';

    public static function toPersian(string $role)
    {
        return __(sprintf('custom.%s', $role));
    }
}
