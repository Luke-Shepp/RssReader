<?php

namespace App\Http\Controllers;

use App\Services\FeedService;
use Illuminate\Contracts\Support\Renderable;

class FeedController extends Controller
{
    /** @var FeedService */
    private $service;

    /**
     * @param FeedService $service
     */
    public function __construct(FeedService $service)
    {
        $this->middleware('auth');

        $this->service = $service;
    }

    /**
     * @param int $feedId
     * @return Renderable
     */
    public function feed(int $feedId): Renderable
    {
        $feed = $this->service->single($feedId);

        if (! $feed) {
            abort(404);
        }

        return view('feed.single', compact('feed'));
    }
}
