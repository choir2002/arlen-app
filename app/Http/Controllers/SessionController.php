<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserSession;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = UserSession::with('user')
        ->orderByDesc('created_at') // Atau gunakan 'updated_at' jika lebih sesuai
        ->get();
        return view('sessions.index', compact('sessions'));
    }
}
