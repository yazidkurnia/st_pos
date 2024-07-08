<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Categories;

class CategoryController extends Controller
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

        return response()->json(['success' => TRUE, 'message' => 'Berhasil menyimpan data']);
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
