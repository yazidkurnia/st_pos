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

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Customer;
use App\Models\Items;
use App\Models\Units;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;
use Session;

class PageController extends Controller
{

    public function indexcategories()
    {
        $categories = Categories::select('*')->get();

        return view('layouts.products.categories_data', [
            'categories' => $categories
        ]);
    }

    public function categoriesstore(Request $request)
    {
        $categories = new Categories();
        $categories->nama = $request->nama;
        $categories->save();

        Session::flash('sukses', 'Data berhasil disimpan!');
        return redirect(route('categories'));
    }

    public function categoriesupdate(Request $request, $id)
    {
        $categories = Categories::find($id);
        $categories->nama = $request->nama;
        $categories->update();

        Session::flash('sukses', 'Data berhasil diupdate!');
        return redirect(route('categories'));
    }

    public function categoriesdestroy(Request $request, $id)
    {
        $categories = Categories::findOrFail($id);
        $categories->delete();

        Session::flash('sukses', 'Data berhasil dihapus!');
        return redirect(route('categories'));
    }

    public function indexunits()
    {
        $units = Units::select('*')->get();

        return view('layouts.products.units_data', [
            'units' => $units
        ]);
    }

    public function unitsstore(Request $request)
    {
        $units = new Units();
        $units->nama = $request->nama;
        $units->save();

        Session::flash('sukses', 'Data berhasil disimpan!');
        return redirect(route('units'));
    }

    public function unitsupdate(Request $request, $id)
    {
        $units = Units::find($id);
        $units->nama = $request->nama;
        $units->update();

        Session::flash('sukses', 'Data berhasil diupdate!');
        return redirect(route('units'));
    }

    public function unitsdestroy(Request $request, $id)
    {
        $units = Units::findOrFail($id);
        $units->delete();

        Session::flash('sukses', 'Data berhasil dihapus!');
        return redirect(route('units'));
    }

    public function indexitems()
    {
        $items = Items::select('barang.*', 'kategori.nama as kategori', 'satuan.nama as satuan', 'vendor.nama as vendor')
                        ->join('kategori', 'kategori.id', '=', 'barang.kategori_id')
                        ->join('satuan', 'satuan.id', '=', 'barang.satuan_id')
                        ->join('vendor', 'vendor.id', '=', 'barang.vendor_id')
                        ->get();

        return view('layouts.products.items_data', [
            'items' => $items
        ]);
    }

    public function itemscreate()
    {
        $satuan = Units::all();
        $vendor = Vendor::all();
        $kategori = Categories::all();

        return view('layouts.products.items_form', [
            'satuan' => $satuan,
            'vendor' => $vendor,
            'kategori' => $kategori,
            'items' => 0,
            'pages' => 'create'
        ]);
    }
}
