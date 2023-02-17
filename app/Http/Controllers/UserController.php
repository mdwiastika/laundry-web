<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('halo');
        $users = User::latest()->get();
        return view('admin.datamaster.user.main', [
            'title' => 'Table User',
            'active' => 'datamaster',
            'users' => $users,
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
        return view('admin.datamaster.user.create', [
            'title' => 'Table User',
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $outlets = Outlet::all();
        return view('admin.datamaster.user.show', [
            'title' => 'Table User',
            'active' => 'datamaster',
            'user' => $user,
            'outlets' => $outlets,
            'outlet_name' => auth()->user()->outlet->nama,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $outlets = Outlet::all();
        return view('admin.datamaster.user.edit', [
            'title' => 'Table User',
            'active' => 'datamaster',
            'user' => $user,
            'outlets' => $outlets,
            'outlet_name' => auth()->user()->outlet->nama,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'username' => 'required',
                'email' => $user->email == $request->email ? 'required' : 'required|unique:users',
                'role' => 'required',
                'id_outlet' => 'required',
            ]);
            if ($request->new_password) {
                $validatedData['password'] = Hash::make($request->new_password);
            }
            $user->update($validatedData);
            return redirect()->route('user.index')->with('success', 'Sukses update user');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('user.index')->with('success', 'Sukses delete user');
        } catch (\Throwable $th) {
            return redirect()->route('user.index')->with('error', $th->getMessage());
        }
    }
}
