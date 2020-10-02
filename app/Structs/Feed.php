<?php

namespace App\Structs;

class Feed
{
    /** @var int */
    public $id;

    /** @var string */
    public $title = '';

    /** @var string */
    public $description = '';

    /** @var string */
    public $link = '';

    /** @var array */
    public $items = [];

    /** @var null|array */
    public $image = null;
}
