<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::latest()->get();
        return view('admin.datamaster.member.main', [
            'title' => 'Table Member',
            'active' => 'datamaster',
            'outlet_name' => auth()->user()->outlet->nama,
            'members' => $members,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.datamaster.member.add', [
            'title' => 'Table Member',
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
                'nama' => 'required|unique:members',
                'alamat' => 'required',
                'jenis_kelamin' => 'required',
                'tlp' => 'required',
                'keterangan' => 'required',
            ]);
            Member::create($validatedData);
            return redirect()->route('member.index')->with('success', 'Sukses insert data member');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return view('admin.datamaster.member.show', [
            'title' => 'Table Member',
            'active' => 'datamaster',
            'outlet_name' => auth()->user()->outlet->nama,
            'member' => $member,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return view('admin.datamaster.member.edit', [
            'title' => 'Table Member',
            'active' => 'datamaster',
            'outlet_name' => auth()->user()->outlet->nama,
            'member' => $member,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        try {
            $validatedData = $request->validate([
                'nama' => $member->nama == $request->nama ? 'required' : 'required|unique:members',
                'alamat' => 'required',
                'jenis_kelamin' => 'required',
                'tlp' => 'required',
                'keterangan' => 'required',
            ]);
            $member->update($validatedData);
            return redirect()->route('member.index')->with('success', 'Sukses update member');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        try {
            $member->delete();
            return redirect()->route('member.index')->with('success', 'Sukses delete member');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
