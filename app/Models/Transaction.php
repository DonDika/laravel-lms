<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'booking_trx_id',
        'user_id',
        'pricing_id',
        'sub_total_amount',
        'grand_total_amount',
        'total_tax_amount',
        'is_paid',
        'payment_type',
        'proof',
        'started_at',
        'ended_at'
    ];

    //ketika disimpan ke db akan menjadi string, sehingga perlu di-cast ulang, convert menjadi date untuk ditampilkan di laravel
    protected $casts = [
        'started_at' => 'date',
        'ended_at' => 'date'
    ];

    //untuk cek student yg mana
    public function student() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //untuk cek paket langganan yg mana
    public function pricing() 
    {
        return $this->belongsTo(Pricing::class, 'pricing_id');
    }

    public function isActive()
    {
        return $this->is_paid && $this->ended_at->isFuture();
    }

}
