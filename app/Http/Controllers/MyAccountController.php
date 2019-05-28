<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyAccountController extends Controller
{
    public function index()
    {
        return view('account.index');
    }

    public function notifications()
    {
        return view('account.notifications', ['notifications' => auth()->user()->notifications]);
    }

    public function updateDetails(Request $request)
    {
        $user = auth()->user();

        $user->validator($request->all())->validate();

        $user->fill($request->toArray())->save();

        return response()->json(['status' => true], 200);
    }

    public function servers()
    {
        return view('account.servers', ['listings' => app('listings')->where('user_id', auth()->id())->sortByDesc('created_at')]);
    }

    public function markNotificationRead(string $key)
    {
        auth()->user()->notifications->firstWhere('id', $key)->markAsRead();
    }

    public function markNotificationUnread(string $key)
    {
        auth()->user()->notifications->firstWhere('id', $key)->markAsUnread();
    }

    public function sendNotificationResponse($read_status)
    {
        return response()->json(['read' => $read_status], 200);
    }
}
