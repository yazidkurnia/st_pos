<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Session;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexsupplier()
    {
        $vendors = Vendor::select('*')->get();
        return view('layouts.supplier.supplier_data', [
            'vendors' => $vendors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function supplierstore(Request $request)
    {
        $vendor = new Vendor();
        $vendor->nama = $request->nama;
        $vendor->telp = $request->telp;
        $vendor->alamat = $request->alamat;
        $vendor->save();

        Session::flash('sukses', 'Data berhasil disimpan!');
        return redirect(route('supplier'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function supplieredit(Request $request)
    {
        $id = $request->id;
        $vendor = Vendor::find($id);

        return view('layouts.supplier.supplier_edit', [
            'vendor' => $vendor
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function supplierupdate(Request $request, $id)
    {
        $vendor = Vendor::find($id);
        $vendor->nama = $request->nama;
        $vendor->telp = $request->telp;
        $vendor->alamat = $request->alamat;
        $vendor->update();

        Session::flash('sukses', 'Data berhasil diupdate!');
        return redirect(route('supplier'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function supplierdestroy(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();

        Session::flash('sukses', 'Data berhasil dihapus!');
        return redirect(route('supplier'));
    }
}
