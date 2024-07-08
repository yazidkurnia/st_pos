<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Customer extends Model
{
    protected $table = 'customer';

    protected $fillable = ['nik', 'name', 'gender', 'dob', 'do_join', 'phone', 'address'];

    public function getIdAttribute($value)
    {
        return Crypt::encryptString($value);
    }
}
