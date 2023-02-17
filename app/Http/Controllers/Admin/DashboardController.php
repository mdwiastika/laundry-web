<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Outlet;
use App\Models\Paket;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function main()
    {
        $user_count = User::count();
        $member_count =  Member::count();
        $paket_count = Paket::count();
        $transaksi_count = Transaksi::count();
        $outlet_count = Outlet::count();
        $outlet_name = auth()->user()->outlet->nama;
        return view('admin.dashboard.main', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'member_count' => $member_count,
            'paket_count' => $paket_count,
            'transaksi_count' => $transaksi_count,
            'outlet_count' => $outlet_count,
            'user_count' => $user_count,
            'outlet_name' => $outlet_name,

        ]);
    }
}
