<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use DataTables;
use Crypt;

class ApiTableController extends Controller
{
    public function load_datatable_supplier(Request $request)
    {
        if ($request->ajax()) {
            $data = Vendor::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('actions', function($row){
                    $btn = '<button type="button" class="btn rounded-pill btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#delModal'.$row->id.'"><i class="bx bx-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

    public function load_data_transaction(string $tipe = NULL)
    {
        $tableData = NULL;
        if ($tipe ==NULL) {
            # code...
            $tableData = Transaction::with('user')->paginate(10)->fragment('data');
        }

        $paginator = [
            'total' => $tableData->total(),
            'per_page' => $tableData->perPage(),
            'current_page' => $tableData->currentPage(),
            'last_page' => $tableData->lastPage(),
        ];

        return response()->json(['success' => true, 'message' => 'Data berhasil didapatkan', 'data' => $tableData->items(), 'paginator' => $paginator]);
    }

    public function load_data_transaction_detail(){
        $tableData = TransactionDetail::paginate(10);
        return response()->json(['success' => true, 'message' => 'Data berhasil didapatkan', 'data' => $tableData]);
    }
}
