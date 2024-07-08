<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Categories extends Model
{
    protected $table = 'kategori';

    protected $fillable = ['nama'];

    public function getIdAttribute($value)
    {
        return Crypt::encryptString($value);
    }
}
