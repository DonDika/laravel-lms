<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pricing extends Model
{
    use SoftDeletes;

    protected $fillable = 
    [
        'name',
        'duration',
        'price'
    ];


    public function transactions() 
    {
        return $this->hasMany(Transaction::class);
    }

    // digunakan di pricing blade
    public function isSubscribedByUser($userId) 
    {
        // dihubungkan dulu ke tabel Transaction menggunakan one-to-many kemudian baru query
        return $this->transactions()
            ->where('user_id', $userId)
            ->where('is_paid', true)
            ->where('ended_at', '>=', now())
            ->exists();
    }

}
