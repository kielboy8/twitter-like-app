<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Notifications\FollowNotification;

class FollowController extends Controller
{
    public function follow($user_id) {
        $user = User::find($user_id);

        if (!$user) {
            return redirect()->back()->with('error', 'User does not exist.');
        }
        if ($user_id == auth()->id()) {
            return redirect()->back()->with('error', 'You can\'t follow yourself!');
        }
        if($user->followers->contains(auth()->id())) {
            return redirect()->back()->with('error', 'You are already following this user.');
        }

        $user->notify(new FollowNotification(auth()->user()));
        $user->followers()->attach(auth()->user()->id);

        return redirect()->back()->with('success', 'You have followed ' . $user->username . '!');
    }

    public function unfollow($user_id) {
        $user = User::find($user_id);

        if (!$user) {
            return redirect()->back()->with('error', 'User does not exist.');
        }
        if ($user_id == auth()->id()) {
            return redirect()->back()->with('error', 'You can\'t unfollow yourself!');
        }
        if(! $user->followers->contains(auth()->id())) {
            return redirect()->back()->with('error', 'You are not following this user.');
        }

        $user->followers()->detach(auth()->user()->id);

        return redirect()->back()->with('success', 'You have unfollowed ' . $user->username . '.');
    }
}
