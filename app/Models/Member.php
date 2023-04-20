<?php

namespace App\Models;

use App\User;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Eloquent
{
    use HasFactory;

    protected $fillable = [ 
        'name', 'dob', 'gender', 'phone', 'thanhpho', 'quan', 'pttt', 'bietct', 'pttttm',
    ];

    public function hoadons()
    { 
        return $this->hasMany(Hoadon::class);
    }

}
