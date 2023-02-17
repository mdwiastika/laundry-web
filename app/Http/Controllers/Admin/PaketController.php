<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pakets = Paket::where('id_outlet', auth()->user()->id_outlet)->latest()->get();
        return view('admin.datamaster.pakets.main', [
            'title' => 'Table Paket',
            'active' => 'datamaster',
            'pakets' => $pakets,
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
        return view('admin.datamaster.pakets.add', [
            'title' => 'Table Paket',
            'active' => 'datamaster',
            'outlet_name' => auth()->user()->outlet->nama,
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
        try {
            $validatedData = $request->validate([
                'jenis' => 'required',
                'nama_paket' => 'required|unique:pakets',
                'harga' => 'required',
            ]);
            $validatedData['id_outlet'] = auth()->user()->id_outlet;
            Paket::create($validatedData);
            return redirect('/paket')->with('success', 'Success add paket');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function show(Paket $paket)
    {
        return view('admin.datamaster.pakets.show', [
            'title' => 'Table Paket',
            'active' => 'datamaster',
            'paket' => $paket,
            'outlet_name' => auth()->user()->outlet->nama,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function edit(Paket $paket)
    {
        return view('admin.datamaster.pakets.edit', [
            'title' => 'Table Paket',
            'active' => 'datamaster',
            'paket' => $paket,
            'outlet_name' => auth()->user()->outlet->nama,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paket $paket)
    {
        try {
            $validatedData = $request->validate([
                'jenis' => 'required',
                'nama_paket' => $paket->nama_paket == $request->nama_paket ? 'required' : 'required|unique:pakets',
                'harga' => 'required',
            ]);
            $paket->update($validatedData);
            return redirect('/paket')->with('success', 'Success edit paket');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paket $paket)
    {
        try {
            $paket->delete();
            return redirect('/paket')->with('success', 'Success delete paket');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
