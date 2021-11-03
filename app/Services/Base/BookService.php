<?php


namespace App\Services\Base;


abstract class BookService
    extends Basic\BasicService
    implements Basic\Creator,
    Basic\Destroyer,
    Basic\Updater,
    Basic\Presenter
{
    // Just an Abstraction!
}
