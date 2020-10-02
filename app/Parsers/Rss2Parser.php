<?php

namespace App\Parsers;

use App\Structs\Feed;
use App\Structs\Image;
use App\Structs\Item;

class Rss2Parser implements FeedParser
{
    /**
     * @inheritDoc
     */
    public function parse(int $feedId, string $feedData): Feed
    {
        $doc = simplexml_load_string($feedData);

        $feed = new Feed();
        $feed->id = $feedId;
        $feed->title = (string) $doc->channel->title ?? '';
        $feed->description = (string) $doc->channel->description ?? '';
        $feed->link = (string) $doc->channel->link ?? '';

        if (! empty($doc->channel->image)) {
            $feed->image = new Image();
            $feed->image->url = (string) $doc->channel->image->url ?? '';
            $feed->image->title = (string) $doc->channel->image->url ?? '';
            $feed->image->link = (string) $doc->channel->image->url ?? '';
        }

        $feed->items = [];
        foreach ($doc->channel->item as $rssItem) {
            $item = new Item();
            $item->description = (string) $rssItem->description ?? '';
            $item->title = (string) $rssItem->title ?? '';
            $item->link = (string) $rssItem->link ?? '';
            $item->published = (string) $rssItem->pubDate ?? '';

            $feed->items[] = $item;
        }

        return $feed;
    }
}
