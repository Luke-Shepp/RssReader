<?php

namespace App\Parsers;

use App\Structs\Feed;

interface FeedParser
{
    /**
     * @param int $feedId
     * @param string $feedData
     * @return Feed
     */
    public function parse(int $feedId, string $feedData): Feed;
}
