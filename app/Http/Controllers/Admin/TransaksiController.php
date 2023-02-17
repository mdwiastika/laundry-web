<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\Member;
use App\Models\Paket;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksis = Transaksi::latest()->get();
        return view('admin.datamaster.transaksis.main', [
            'title' => 'Table Transaksi',
            'active' => 'Laporan',
            'transaksis' => $transaksis,
            'outlet_name' => auth()->user()->outlet->nama,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::all();
        $pakets = Paket::all();
        return view('admin.datamaster.transaksis.add', [
            'title' => 'Table Transaksi',
            'active' => 'Laporan',
            'members' => $members,
            'pakets' => $pakets,
            'outlet_name' => auth()->user()->outlet->nama,
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
        DB::beginTransaction();
        try {
            // check member customer
            $member = Member::where('id', $request->id_member)->first();
            $member_diskon = 0;
            // validate form for TransaksiTable
            $validatedData = $request->validate([
                'id_member' => 'required',
                'tanggal_order' => 'required',
            ]);
            if ($member->keterangan == 'member') {
                $member_diskon = 10;
            }
            $validatedData['id_outlet'] = auth()->user()->id_outlet;
            $validatedData['batas_waktu'] = Carbon::parse($request->tanggal_order)->addDays(3);
            $validatedData['user_id'] = auth()->user()->id;
            $validatedData['diskon'] = $member_diskon;
            $validatedData['status'] = 'baru';
            $validatedData['dibayar'] = 'belum_dibayar';
            $validatedData['pajak'] = 5;
            $validatedData['id_user'] = auth()->user()->id;
            // create transaksi
            $transaksi = Transaksi::create($validatedData);
            $nomer_resi = 'KI-' . str_pad($transaksi->id, 4, '0', STR_PAD_LEFT);
            $transaksi->update([
                'kode_invoice' => $nomer_resi,
            ]);

            // validate form for DetailTransaksitable
            $validatedTransaksiDetail = $request->validate([
                'id_paket' => 'required',
                'qty' => 'required',
                'keterangan' => 'required',
            ]);
            $validatedTransaksiDetail['id_transaksi'] = $transaksi->id;
            DetailTransaksi::create($validatedTransaksiDetail);
            DB::commit();
            return redirect()->route('transaksi.index')->with('success', 'Succes add transaksi');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        $members = Member::all();
        $pakets = Paket::all();
        return view('admin.datamaster.transaksis.show', [
            'title' => 'Table Transaksi',
            'active' => 'Laporan',
            'transaksi' => $transaksi,
            'members' => $members,
            'pakets' => $pakets,
            'outlet_name' => auth()->user()->outlet->nama,
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
        $members = Member::all();
        $pakets = Paket::all();
        return view('admin.datamaster.transaksis.edit', [
            'title' => 'Table Transaksi',
            'active' => 'Laporan',
            'transaksi' => $transaksi,
            'members' => $members,
            'pakets' => $pakets,
            'outlet_name' => auth()->user()->outlet->nama,

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
        DB::beginTransaction();
        try {
            // Update Transaksi
            $validatedData = $request->validate([
                'status' => 'required',
                'dibayar' => 'required',
                'biaya_tambahan' => 'required',
            ]);
            if ($request->tanggal_bayar) {
                $validatedData['tanggal_bayar'] = $request->tanggal_bayar;
            }
            $transaksi->update($validatedData);
            DB::commit();
            return redirect('/transaksi')->with('success', 'Sukses update transaksi');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        DB::beginTransaction();
        try {
            $detail_transaksi = DetailTransaksi::where('id_transaksi', $transaksi->id)->first();
            $detail_transaksi->delete();
            $transaksi->delete();
            DB::commit();
            return redirect('/transaksi')->with('success', 'Success delete transaksi');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
