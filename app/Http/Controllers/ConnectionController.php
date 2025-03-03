<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ConnectionController extends Controller
{
    public function connect(User $user)
    {
        $user->connections()->sync(auth()->user()->id);
        return response()->json([
            'success' => true,
        ]);
    }

}
