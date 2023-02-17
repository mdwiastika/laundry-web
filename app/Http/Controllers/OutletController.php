<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlets = Outlet::all();
        return view('admin.datamaster.outlet.main', [
            'title' => 'Table Outlet',
            'active' => 'datamaster',
            'outlets' => $outlets,
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
        return view('admin.datamaster.outlet.create', [
            'title' => 'Table Outlet',
            'active' => 'datamaster',
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
                'nama' => 'required|unique:outlets,nama',
                'alamat' => 'required',
                'tlp' => 'required',
            ]);
            Outlet::create($validatedData);
            return redirect()->route('outlet.index')->with('success', 'Sukses insert outlet');
        } catch (\Throwable $th) {
            return redirect()->route('outlet.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function show(Outlet $outlet)
    {
        return view('admin.datamaster.outlet.show', [
            'title' => 'Table Outlet',
            'active' => 'datamaster',
            'outlet' => $outlet,
            'outlet_name' => auth()->user()->outlet->nama,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function edit(Outlet $outlet)
    {
        return view('admin.datamaster.outlet.edit', [
            'title' => 'Table Outlet',
            'active' => 'datamaster',
            'outlet' => $outlet,
            'outlet_name' => auth()->user()->outlet->nama,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outlet $outlet)
    {
        try {
            $validatedData = $request->validate([
                'nama' => $request->nama == $outlet->nama ? 'required' : 'required|unique:outlets',
                'alamat' => 'required',
                'tlp' => 'required',
            ]);
            $outlet->update($validatedData);
            return redirect()->route('outlet.index')->with('success', 'Sukses update outlet');
        } catch (\Throwable $th) {
            return redirect()->route('outlet.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outlet $outlet)
    {
        try {
            $outlet->delete();
            return redirect()->route('outlet.index')->with('success', 'Sukses delete outlet');
        } catch (\Throwable $th) {
            return redirect()->route('outlet.index')->with('error', $th->getMessage());
        }
    }
}
