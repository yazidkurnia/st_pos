<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Crypt;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'kasir_id', 'jumlahbayar', 'statuspembayaran', 'uuid'
    ];

    public function getIdAttribute($value)
    {
        return Crypt::encryptString($value);
    }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y H:i:s');
    }

    /**
     * Get the user that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }
}
