<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = auth()->user()->notifications;
        foreach ($notifications as $notification) {
            $notification->markAsRead();
        }
        return view('notifications', compact('notifications'));
    }
}
