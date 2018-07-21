<?php

namespace App\Http\Controllers;

use App\Post;
use App\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug = null)
    {
        $news = new News();

        $newshub = $news->latest()->paginate(4);


        $query = $slug
            ? \App\Tag::whereSlug($slug)->firstOrFail()->posts()
            : new \App\Post;

        $posts = $query->latest()->paginate(9);

        return view('index', compact('newshub', 'posts'));
    }
}
