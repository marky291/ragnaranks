<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Notification;

class MyAccountController extends Controller
{
    public function index() {
        return view('account.index');
    }
    public function notifications() {
        return view('account.notifications', ['notifications' => auth()->user()->notifications]);
    }

    public function markNotificationRead(string $key) {
        auth()->user()->notifications->firstWhere('id', $key)->markAsRead();
    }

    public function markNotificationUnread(string $key) {
        auth()->user()->notifications->firstWhere('id', $key)->markAsUnread();
    }

    public function sendNotificationResponse($read_status) {
        return response()->json(['read' => $read_status], 200);
    }
}
