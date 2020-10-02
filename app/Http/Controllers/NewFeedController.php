<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewFeedRequest;
use App\Services\FeedService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class NewFeedController extends Controller
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
     * Display the new feed form.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('feed.new');
    }

    /**
     * @param NewFeedRequest $request
     * @return RedirectResponse
     */
    public function save(NewFeedRequest $request): RedirectResponse
    {
        $success = $this->service->create($request->input('feed_url'));

        if ($success) {
            return redirect()->to(route('home'))->with('status', __('feed.created'));
        }

        return redirect()->back()->with('status', __('feed.error'));
    }
}
