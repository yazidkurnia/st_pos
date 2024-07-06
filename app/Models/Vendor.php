<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Vendor extends Model
{
    protected $table = 'vendor';

    protected $fillable = ['nama', 'telp', 'alamat'];

    public function getIdAttribute($value)
    {
        return Crypt::encryptString($value);
    }

}
