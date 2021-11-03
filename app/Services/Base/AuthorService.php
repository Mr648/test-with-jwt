<?php


namespace App\Services\Base;

use App\Services\Base\Basic\BasicService;

abstract class AuthorService
    extends BasicService
    implements Basic\Creator
    , Basic\Updater
    , Basic\Presenter
    , Basic\Destroyer
{
    // Just an Abstraction!
}
