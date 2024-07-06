<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use DataTables;

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
}
