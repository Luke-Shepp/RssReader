<?php

namespace App\Services;

use App\Models\Feed as FeedModel;
use App\Structs\Feed;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class FeedService
{
    /** @var FeedFetcher */
    private $fetcher;

    /**
     * @param FeedFetcher $fetcher
     */
    public function __construct(FeedFetcher $fetcher)
    {
        $this->fetcher = $fetcher;
    }

    /**
     * @param string $url
     * @return bool
     */
    public function create(string $url): bool
    {
        $feed = new FeedModel([
            'user_id' => Auth::user()->id,
            'url'     => $url
        ]);

        return $feed->save();
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        $feeds = FeedModel::where('user_id', Auth::user()->id)->get();

        $parsed = new Collection;

        foreach ($feeds as $feed) {
            $parsed->add($this->fetcher->fetch($feed));
        }

        return $parsed;
    }

    /**
     * @param int $feedId
     * @return null|Collection
     */
    public function single(int $feedId): ?Feed
    {
        $feed = FeedModel::find($feedId);

        if (! $feed) {
            return null;
        }

        return $this->fetcher->fetch($feed);
    }
}
