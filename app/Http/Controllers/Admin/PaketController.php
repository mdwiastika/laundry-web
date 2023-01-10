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
        $pakets = Paket::all();
        return view('admin.datamaster.pakets.main', [
            'title' => 'Table Paket',
            'active' => 'datamaster',
            'pakets' => $pakets,
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
            'title' => 'Create Paket',
            'active' => 'datamaster',
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
            Paket::create($validatedData);
            return redirect('/paket')->with('message', 'Success add paket');
        } catch (\Throwable $th) {
            return back()->with('message', $th->getMessage());
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
            'title' => 'Show Paket',
            'active' => 'datamaster',
            'paket' => $paket,
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
            'title' => 'Edit Paket',
            'active' => 'datamaster',
            'paket' => $paket,
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
                'nama_paket' => 'required|unique:pakets',
                'harga' => 'required',
            ]);
            $paket->update($validatedData);
            return redirect('/paket')->with('message', 'Success edit paket');
        } catch (\Throwable $th) {
            return back()->with('message', $th->getMessage());
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
            return redirect('/paket')->with('message', 'Success delete paket');
        } catch (\Throwable $th) {
            return back()->with('message', $th->getMessage());
        }
    }
}
