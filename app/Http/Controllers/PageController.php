<?php

// Konvensi penamaan fungsi:
// - Gunakan camelCase untuk nama fungsi
// - Beri nama yang deskriptif dan singkat
// - Hindari menggunakan singkatan kecuali jika sudah umum digunakan

// Contoh: nama fungsi yang baik
// public function calculateTotalPrice() {}

// Contoh: nama fungsi yang tidak baik (gunakan singkatan)
// public function ctP() {}

// Dokumentasi fungsi:
// - Gunakan komentar PHPDoc untuk mendokumentasikan fungsi
// - Sertakan deskripsi singkat tentang fungsi
// - Sertakan informasi tentang nilai kembali dan parameter apa pun

// Contoh: dokumentasi fungsi yang baik
/**
 * Menghitung total harga produk.
 *
 * @param float $price Harga produk
 * @param int $quantity Jumlah produk
 * @return float Total harga produk
 */
// public function calculateTotalPrice(float $price, int $quantity) {
//     return $price * $quantity;
// }

// Badan fungsi:
// - Pastikan badan fungsi singkat dan fokus pada satu tugas
// - Hindari logika kompleks dan pertimbangkan memecahnya menjadi fungsi yang lebih kecil
// - Gunakan nama variabel yang bermakna dan pertimbangkan menggunakan type hints

// Contoh: badan fungsi yang baik
// public function calculateTotalPrice(float $price, int $quantity) {
//     $totalPrice = $price * $quantity;
//     return $totalPrice;
// }

// Contoh: badan fungsi yang tidak baik (logika kompleks)
// public function calculateTotalPrice(float $price, int $quantity) {
//     if ($price > 100) {
//         $discount = 0.1;
//     } else {
//         $discount = 0.05;
//     }
//     $totalPrice = $price * $quantity * (1 - $discount);
//     return $totalPrice;
// }

// Contoh: badan fungsi yang lebih baik (memecah logika kompleks menjadi fungsi yang lebih kecil)
// public function calculateTotalPrice(float $price, int $quantity) {
//     $discount = getDiscount($price);
//     $totalPrice = $price * $quantity * (1 - $discount);
//     return $totalPrice;
// }

// public function getDiscount(float $price) {
//     if ($price > 100) {
//         return 0.1;
//     } else {
//         return 0.05;
//     }
// }

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

    public function indexcustomer()
    {
        $customer = Customer::select('*')->get();

        return view('layouts.customer.customer_data', [
            'customers' => $customer
        ]);
    }

    public function customerstore(Request $request)
    {
        $customer = new Customer();
        $customer->nik = $request->nik;
        $customer->name = $request->nama;
        $customer->gender = $request->gender;
        $customer->dob = $request->dob;
        $customer->do_join = $request->do_join;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();

        Session::flash('sukses', 'Data berhasil disimpan!');
        return redirect(route('customer'));
    }

    public function customerupdate(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->nik = $request->nik;
        $customer->name = $request->nama;
        $customer->gender = $request->gender;
        $customer->dob = $request->dob;
        $customer->do_join = $request->do_join;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->update();

        Session::flash('sukses', 'Data berhasil diupdate!');
        return redirect(route('customer'));
    }

    public function customerdestroy(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        Session::flash('sukses', 'Data berhasil dihapus!');
        return redirect(route('customer'));
    }

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
