<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Categories;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categories::select('*')->get();

        return view('layouts.categories.index', [
            'categories' => $categories
        ]);
    }

    public function categoriesstore(Request $request)
    {
        $categories = new Categories();
        $categories->nama = $request->nama;
        $categories->save();

        return response()->json(['success' => TRUE, 'message' => 'Berhasil menyimpan data']);
    }

    public function category_edit($id){

        $validId = $id != '' ? is_int((int)Crypt::decryptString($id)) ? (int)Crypt::decryptString($id) : NULL : NULL;
        $category = Categories::find($validId);
        // dd($category);
        return response()->json(['success' => TRUE, 'data' => $category, 'message' => 'Berhasil mengambil data']);
    }

    public function categoriesupdate(Request $request, $id)
    {
        $categories = Categories::find($id);
        $categories->nama = $request->nama;
        $categories->update();

        return response()->json(['success' => TRUE, 'message' => 'Berhasil merubah data']);
    }

    public function categoriesdestroy(Request $request, $id)
    {
        $categories = Categories::findOrFail($id);
        $categories->delete();

        return response()->json(['success' => TRUE, 'message' => 'Berhasil menghapus data']);
    }
}
