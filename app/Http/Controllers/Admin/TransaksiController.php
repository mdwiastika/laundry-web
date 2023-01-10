<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\DetailTransaksi;
use App\Models\Paket;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksis = Transaksi::all();
        return view('admin.datamaster.transaksis.main', [
            'title' => 'Table Transaksi',
            'active' => 'Laporan',
            'transaksis' => $transaksis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $pakets = Paket::all();
        return view('admin.datamaster.transaksis.add', [
            'title' => 'Table Transaksi',
            'active' => 'Laporan',
            'customers' => $customers,
            'pakets' => $pakets,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // check member customer
        $customer = Customer::where('id', $request->id_cust)->first();
        $cus_diskon = 0;
        // validate form for TransaksiTable
        $validatedData = $request->validate([
            'id_cust' => 'required',
            'tanggal_order' => 'required',
        ]);
        if ($customer->keterangan == 'member') {
            $cus_diskon = 10;
        }

        $validatedData['batas_waktu'] = Carbon::parse($request->tanggal_order)->addDays(3);
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['diskon'] = $cus_diskon;
        $validatedData['status'] = 'baru';
        $validatedData['dibayar'] = 'belum_dibayar';

        // create transaksi
        $transaksi = Transaksi::create($validatedData);
        $nomer_resi = 'KI-' . str_pad($transaksi->id, 4, '0', STR_PAD_LEFT);
        $transaksi->update([
            'kode_invoice' => $nomer_resi,
        ]);

        // validate form for DetailTransaksitable
        $validatedTransaksiDetail = $request->validate([
            'paket_id' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required',
        ]);
        $validatedTransaksiDetail['transaksi_id'] = $transaksi->id;
        DetailTransaksi::create($validatedTransaksiDetail);
        return redirect('/transaksi')->with('message', 'Succes add transaksi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        $customers = Customer::all();
        $pakets = Paket::all();
        return view('admin.datamaster.transaksis.show', [
            'title' => 'Table Transaksi',
            'active' => 'Laporan',
            'transaksi' => $transaksi,
            'customers' => $customers,
            'pakets' => $pakets,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        $customers = Customer::all();
        $pakets = Paket::all();
        return view('admin.datamaster.transaksis.edit', [
            'title' => 'Edit Transaksi',
            'active' => 'Laporan',
            'transaksi' => $transaksi,
            'customers' => $customers,
            'pakets' => $pakets,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $detail_transaksi = DetailTransaksi::where('transaksi_id', $transaksi->id)->first();
        // Update Transaksi
        $validatedData = $request->validate([
            'status' => 'required',
            'dibayar' => 'required',
        ]);
        $denda_hari = 0;
        if ($transaksi->customer->keterangan == 'member') {
            $diskon_member = 10;
        } else {
            $diskon_member = 0;
        }
        if ($request->tanggal_bayar) {
            $tanggal_bayar = new Carbon($request->tanggal_bayar);
            $batas_waktu = new Carbon($transaksi->batas_waktu);
            if ($tanggal_bayar->greaterThan($batas_waktu)) {
                // Telat bayar
                $denda_hari = Carbon::parse($tanggal_bayar)->diffInDays($batas_waktu);
                // Total denda (jumlah tanggat hari * 4000)
                $total_denda = 4000 * $denda_hari;
                $awal_bayar = ($detail_transaksi->paket->harga * $detail_transaksi->jumlah) + $total_denda;
                $total_diskon = $diskon_member / 100 * $awal_bayar;
                $total_bayar = $awal_bayar - $total_diskon;
                $validatedData['biaya_tambahan'] = $total_bayar;
            } else {
                $awal_bayar = $detail_transaksi->paket->harga * $detail_transaksi->jumlah;
                $total_diskon = $diskon_member / 100 * $awal_bayar;
                $total_bayar = $awal_bayar - $total_diskon;
                $validatedData['biaya_tambahan'] = $total_bayar;
            }
            $validatedData['tanggal_bayar'] = $request->tanggal_bayar;
        }
        $transaksi->update($validatedData);
        return redirect('/transaksi')->with('message', 'Sukses update transaksi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        $detail_transaksi = DetailTransaksi::where('transaksi_id', $transaksi->id)->first();
        $detail_transaksi->delete();
        $transaksi->delete();
        return redirect('/transaksi')->with('message', 'Success delete transaksi');
    }
}
