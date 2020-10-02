<?php

namespace App\Http\Controllers;

use App\Services\FeedService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /** @var FeedService */
    private $feedService;

    /**
     * @param FeedService $feedService
     */
    public function __construct(FeedService $feedService)
    {
        $this->middleware('auth');
        $this->feedService = $feedService;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $feeds = $this->feedService->all();

        return view('home', compact('feeds'));
    }
}
