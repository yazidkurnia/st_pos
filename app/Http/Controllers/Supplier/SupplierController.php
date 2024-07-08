<?php

// Konvensi penamaan fungsi:
// - Gunakan camelCase untuk nama fungsi
// - Beri nama yang deskriptif dan singkat
// - Hindari menggunakan singkatan kecuali jika sudah umum digunakan

// Contoh: nama fungsi yang baik
// public function calculateTotalPrice() {}

// Contoh: nama fungsi yang tidak baik (gunakan singkatan)
// public function ctP() {}

// Contoh: dokumentasi fungsi yang baik
/**
 * Menghitung total harga produk.
 *
 * @param float $price Harga produk
 * @param int $quantity Jumlah produk
 * @return float Total harga produk
 */
// public function calculateTotalPrice(float $price, int $quantity)

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Session;
use Illuminate\Support\Facades\Crypt;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::select('id', 'nama', 'alamat', 'telp')->get();
        $pageData['vendors'] = $vendors;
        // dd($vendors);
        return view('layouts.supplier.index', $pageData);
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
    
        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan!']);
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
    public function supplierupdate(Request $request)
    {
        if (!isset($request->_token)) {
            return response()->json(['error' => true, 'message' => 'Gagal merubah data!']);
        }

        if (empty($request->_token)) {
            return response()->json(['error' => true, 'message' => 'Gagal merubah data!']);
        }

        $validId = $request->id != '' ? is_int((int)Crypt::decryptString($request->id)) ? (int)Crypt::decryptString($request->id) : NULL : NULL;

        if ($validId == NULL) {
            return response()->json(['error' => true, 'message' => 'Gagal merubah data!']);
        }

        // dd(Crypt::decryptString($request->id));
        $vendor = Vendor::find($validId);
        $vendor->nama = $request->nama;
        $vendor->telp = $request->telp;
        $vendor->alamat = $request->alamat;
        $vendor->update();

        return response()->json(['success' => true, 'message' => 'Data berhasil dirubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function supplierdestroy(Request $request)
    {
        if (!isset($request->_token)) {
            return response()->json(['error' => true, 'message' => 'Gagal merubah data!']);
        }

        if (empty($request->_token)) {
            return response()->json(['error' => true, 'message' => 'Gagal merubah data!']);
        }

        $validId = $request->id_todalate != '' ? is_int((int)Crypt::decryptString($request->id_todalate)) ? (int)Crypt::decryptString($request->id_todalate) : NULL : NULL;

        if ($validId == NULL) {
            return response()->json(['error' => true, 'message' => 'Gagal merubah data!']);
        }

        // dd($validId);
        $vendor = Vendor::findOrFail($validId);

        $vendor->delete();

        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus!']);
    }
}
