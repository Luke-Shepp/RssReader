<?php

namespace App\Factories;

use App\Models\Feed;
use App\Parsers\FeedParser;
use App\Parsers\Rss2Parser;

class ParserFactory
{
    /**
     * @param Feed $feed
     * @param string $feedData
     * @return FeedParser|null
     */
    public function make(Feed $feed, string $feedData): ?FeedParser
    {
        // To check if the feed is of XML type, attempt to parse the data as XML, surpressing errors.
        $doc = @simplexml_load_string($feedData);

        if ($doc && ! empty($doc->attributes()->version)) {
            switch ($doc->attributes()->version) {
                case 1:
                    // Example; return new Rss1Parser();
                    break;

                case 2:
                    return new Rss2Parser();
            }
        }

        // Any additional feed types can be determined in this method and their parser
        // returned as necessary.

        return null;
    }
}
