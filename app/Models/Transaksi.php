<?php

namespace App\Models;

use App\Models\User;
use App\Models\Itemtransaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_harga',
        'tunai',
        'kembali',
    ];

    /**
     * Get the user that owns the Transaksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the comments for the Transaksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function itemtransaksis()
    {
        return $this->hasMany(Itemtransaksi::class);
    }
}
