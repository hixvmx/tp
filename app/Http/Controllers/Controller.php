<?php

namespace App\Http\Controllers;
use App\Events\NotifEvent;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    // share notification with other admins using PUSHER
    public function newNotification($mssg = "Unknown message!")
    {
        $authUserName = Auth::user()->name ?? "unknown";
        NotifEvent::dispatch(strtoupper($authUserName) . ': ' . $mssg);
    }
}
