<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'address',
        'birth_date',
        'phone_number',
        'cicle_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function cicle()
    {
        return $this->belongsTo(Cicle::class);
    }
}
