<?php



namespace App\Http\Controllers\Membership;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Crypt;

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

class MembershipController extends Controller
{
    public function index()
    {
        $pageData['title']     = 'Customer';
        $pageData['customers'] = Customer::select('*')->get();
        return view('layouts.customer.index', $pageData);
    }

    public function customerstore(Request $request)
    {
       
        $validatedData = $request->validate([
            '_token' => 'required',
            'nik' => 'required',
            'nama' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'do_join' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        // dd($request->input());
        $customer = new Customer();
        $customer->nik = $request->nik;
        $customer->name = $request->nama;
        $customer->gender = $request->gender;
        $customer->dob = $request->dob;
        $customer->do_join = $request->do_join;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();

        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan!']);
    }

    public function customer_edit($id){
        $validId = $id != '' ? is_int((int)Crypt::decryptString($id)) ? (int)Crypt::decryptString($id ): NULL : NULL;
        
        $pageData = Customer::find($validId);
        return response()->json($pageData);
    }

    public function customerupdate(Request $request)
    {
        $validatedData = $request->validate([
            '_token' => 'required',
            'nik' => 'required',
            'nama' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'do_join' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $id = $request->_id != '' ? is_int((int)Crypt::decryptString($request->_id)) ? (int)Crypt::decryptString($request->_id) : NULL : NULL;
        // dd($id);

        $customer = Customer::find($id);

        if (empty($customer)) {
            return response()->json(['error' => true, 'message' => 'Data customer yang akan dirubah tidak ditemukan!']);
        }

        $customer->nik = $request->nik;
        $customer->name = $request->nama;
        $customer->gender = $request->gender;
        $customer->dob = $request->dob;
        $customer->do_join = $request->do_join;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->update();

        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan!']);
    }

    public function customerdestroy(Request $request)
    {
        if (empty($request->_token) || $request->_token == '') {
            return response()->json(['error' => TRUE, 'message' => 'Data gagal dihapus']);
        }

        $validId = $request->deletedId != '' ? is_int((int)Crypt::decryptString($request->deletedId)) ? (int)Crypt::decryptString($request->deletedId) : NULL : NULL;

        $customer = Customer::findOrFail($validId);
        $customer->delete();
        return response()->json(['success' => TRUE, 'message' => 'Data berhasil dihapus']);
    }
}
