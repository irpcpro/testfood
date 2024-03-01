<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'address',
        'lat',
        'long',
    ];


    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
