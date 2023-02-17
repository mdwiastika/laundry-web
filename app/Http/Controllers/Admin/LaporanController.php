<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function main(Request $request)
    {
        if (isset($request->tanggal_awal) && isset($request->tanggal_akhir)) {
            $transaksis = Transaksi::whereBetween('tanggal_order', [$request->tanggal_awal, $request->tanggal_akhir])->latest()->get();
        } else {
            $transaksis = Transaksi::latest()->get();
        }
        return view('admin.laporan.main', [
            'title' => 'Laporan Pembelian',
            'active' => 'Laporan',
            'transaksis' => $transaksis,
            'outlet_name' => auth()->user()->outlet->nama,
        ]);
    }
}
