<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('admin.datamaster.customers.main', [
            'title' => 'Table Customer',
            'active' => 'datamaster',
            'customers' => $customers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.datamaster.customers.add', [
            'title' => 'Table Customer',
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
        $validatedData = $request->validate([
            'name' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'telepon' => 'required',
            'keterangan' => 'required',
        ]);
        Customer::create($validatedData);
        return redirect('/customer')->with('message', 'Sukses Add Customer');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('admin.datamaster.customers.show', [
            'title' => 'Table Customer',
            'active' => 'datamaster',
            'customer' => $customer,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('admin.datamaster.customers.edit', [
            'title' => 'Table Customer',
            'active' => 'datamaster',
            'customer' => $customer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'alamat' => 'required',
                'jenis_kelamin' => 'required',
                'telepon' => 'required',
                'keterangan' => 'required',
            ]);
            $customer->update($validatedData);
            return redirect('/customer')->with('message', 'Sukses update customer');
        } catch (\Throwable $th) {
            return redirect('/customer')->with('message', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
            return redirect('/customer')->with('message', 'Sukses delete customer');
        } catch (\Throwable $th) {
            return redirect('/customer')->with('message', $th->getMessage());
        }
    }
}
