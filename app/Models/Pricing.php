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

}
