<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $permisos = $user->rolData?->permisos ?? collect();

        return view('dashboard.index', compact('user', 'permisos'));
    }
}
