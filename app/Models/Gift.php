<?php

namespace App\Models;

use App\User;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gift extends Eloquent
{
    use HasFactory;

    protected $fillable = [
        'brand', 'type', 'count', 'content', 'image', 'date_start', 'date_end'
    ];

     

}
