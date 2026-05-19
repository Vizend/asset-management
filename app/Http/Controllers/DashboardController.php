<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function redirect()
    {
        $role = auth()->user()->role->name;

        return match ($role) {
            'Admin IT' => redirect()->route('admin.dashboard'),
            'Staff' => redirect()->route('staff.dashboard'),
            'Manager' => redirect()->route('manager.dashboard'),
            default => abort(403, 'Unauthorized'),
        };
    }

    public function admin()
    {
        return view('admin.dashboard');
    }

    public function staff()
    {
        return view('staff.dashboard');
    }

    public function manager()
    {
        return view('manager.dashboard');
    }
}
