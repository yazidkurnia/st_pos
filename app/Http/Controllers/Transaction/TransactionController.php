<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Illuminate\Support\Str;
use DB;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
    public function pay_order(Request $request)
    {
        if (empty($request->items)) {
            return response()->json(['success' => false, 'message' => 'Maaf anda belum memilih item']);
        }
    
        $request->items = array_filter(array_map(function($item) {
            $item['barang_id'] = $item['barang_id'] != '' ? is_int((int)Crypt::decryptString($item['barang_id'])) ? (int)Crypt::decryptString($item['barang_id']) != 0 ? (int)Crypt::decryptString($item['barang_id']) : NULL : NULL : NULL;
            $item['hargaitemxqty'] = $item['hargaitemxqty'] * $item['jumlahbeli'];
            return $item['barang_id'] ? $item : null;
        }, $request->items));
    
        if (empty($request->items)) {
            return response()->json(['success' => false, 'message' => 'Item yang dipilih tidak valid']);
        }
    
        $totalHarga = array_sum(array_column($request->items, 'hargaitemxqty'));
    
        $transactionIds = [];
    
        DB::transaction(function () use ($request, $totalHarga, &$transactionIds) {
            /// susun data yang akan disimpan sebagai data transaksi
            $data = [
                        'kasir_id' => Auth::user()->id,
                        'jumlahbayar' => $totalHarga,
                        'statuspembayaran' => 1,
                        'uuid' => (string) Str::uuid(),
                        // Add other fields as necessary
            ];
            $dataTransaction = Transaction::create($data);

            /// tambahkan data transaction id kedalam array request
            $request->items = array_map(function($item) use ($dataTransaction) {
                unset($item['name']);
                $item['transaction_id'] = $dataTransaction->id;
                // $item['uuid'] = Str::uuid();
                return $item;
            }, $request->items);
            // dd($request->items);
            TransactionDetail::insert($request->items);

        });
    
        return response()->json(['success' => true, 'message' => 'Order Success', 'data' => $transactionIds]);
    }
    
}
