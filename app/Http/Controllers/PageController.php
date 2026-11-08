<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class PageController extends Controller
{
    public function profile(): View
    {
        $user = User::query()->first();

        return view('profile', compact('user'));
    }

    public function about(): View
    {
        return view('about');
    }
}
