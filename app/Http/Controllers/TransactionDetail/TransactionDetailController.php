<?php

namespace App\Http\Controllers\TransactionDetail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Crypt;
use App\Models\TransactionDetail;
use App\Models\User;

class TransactionDetailController extends Controller
{
    public function detail_transaction(string $id)
    {
        $validId = (int)Crypt::decryptString($id);
        $pageData['data_detail_transaction'] = TransactionDetail::join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
                                               ->join('barang', 'barang.id', '=', 'transaction_details.barang_id')
                                               ->where('transaction_details.id', $validId)
                                               ->get();
        
        $pageData['data_kasir'] = [];
        // dd(empty($pageData['data_kasir']));
        if($pageData['data_detail_transaction']->isEmpty()){
            return redirect()->back()->with('error', 'Tidak ditemukan data transaksi, silahkan kontak admin');
        }
        
        $pageData['data_kasir'] = User::find($pageData['data_detail_transaction'][0]->kasir_id);
        $pageData['title'] = 'Transaction Detail';
        return view('layouts.transaction_detail.detail', $pageData);
    }
}
