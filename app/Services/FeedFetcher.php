<?php

namespace App\Services;

use App\Factories\ParserFactory;
use App\Models\Feed as FeedModel;
use App\Structs\Feed;
use Illuminate\Support\Facades\Config;

class FeedFetcher
{
    /** @var string */
    private $cacheDirectory;

    /** @var int */
    private $maxCacheAge;

    /** @var ParserFactory */
    private $parserFactory;

    /**
     * @param ParserFactory $parserFactory
     */
    public function __construct(ParserFactory $parserFactory)
    {
        $this->cacheDirectory = Config::get('feed.cache_dir', storage_path('framework/cache/'));
        $this->maxCacheAge    = Config::get('feed.max_cache_age', 3600);
        $this->parserFactory  = $parserFactory;
    }

    /**
     * @param FeedModel $feed
     * @return null|Feed
     */
    public function fetch(FeedModel $feed): ?Feed
    {
        if (! $this->cacheExpired($feed)) {
            $feedData = $this->getCached($feed);
        } else {
            $feedData = file_get_contents($feed->url);
            $this->cache($feed, $feedData);
        }

        $parser = $this->parserFactory->make($feed, $feedData);

        if (! $parser) {
            return null;
        }

        return $parser->parse($feed->id, $feedData);
    }

    /**
     * @param FeedModel $feed
     * @param string $feedData
     */
    private function cache(FeedModel $feed, string $feedData)
    {
        file_put_contents($this->cacheDirectory . $feed->id, $feedData);
    }

    /**
     * @param FeedModel $feed
     * @return string
     */
    private function getCached(FeedModel $feed): string
    {
        return file_get_contents($this->cacheDirectory . $feed->id);
    }

    /**
     * @param FeedModel $feed
     * @return bool
     */
    private function cacheExpired(FeedModel $feed): bool
    {
        $filename = $this->cacheDirectory . $feed->id;
        return (! file_exists($filename) || filemtime($filename) > time() + $this->maxCacheAge);
    }
}
