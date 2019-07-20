<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Post;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        if(auth()->check()) {
            $user = User::with('following.posts')->find(auth()->id());
            $your_posts = User::find(auth()->id())->posts;
            $following_posts = $user->following->pluck('posts');
            $merged = $following_posts->push($your_posts);
            $posts = (new Collection ($merged))->collapse()->unique();
        }
        else {
            $posts = [];
        }

        return view('home', compact('posts'));
    }
}
