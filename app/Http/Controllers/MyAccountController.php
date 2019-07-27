<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Resources\ListingResource;
use App\Http\Requests\ModifyAccountRequest;

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

    /**
     * Assigns a new user api token and returns for json.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshApiToken()
    {
        /** @var User $user */
        $user = auth()->user();

        $user->refreshApiToken()->save();

        return response()->json(['token' => $user->api_token]);
    }

    public function servers()
    {
        return view('account.servers', [
            'listings' => ListingResource::collection(auth()->user()->listings()->with(['configuration', 'tags', 'ranking', 'language'])->withTrashed()->get()),
        ]);
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
