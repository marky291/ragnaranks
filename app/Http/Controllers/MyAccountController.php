<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModifyAccountRequest;
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

    public function updateDetails(ModifyAccountRequest $request)
    {
        $user = auth()->user();

        $user->fill($request->validated())->save();

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
