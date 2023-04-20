<?php

namespace App\Models;

use App\User;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hoadon extends Eloquent
{
    use HasFactory;

    protected $fillable = [ 
        'member_id', 'cuahang_id', 'cost',
    ];


    public function my_member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
     
    public function my_cuahang()
    {
        return $this->belongsTo(Cuahang::class, 'cuahang_id');
    }

}
