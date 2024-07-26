<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Items extends Model
{
    protected $table = 'barang';

    protected $fillable = ['barcode', 'nama_barang', 'harga_jual', 'harga_modal', 'satuan_id', 'vendor_id', 'kategori_id'];

    public function getIdAttribute($value)
    {
        return Crypt::encryptString($value);
    }
}
