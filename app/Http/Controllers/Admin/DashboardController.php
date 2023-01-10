<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function main()
    {
        return view('admin.dashboard.main', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
        ]);
    }
}
