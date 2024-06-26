<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shopping_list extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'user_id'
    ];

    protected $guarded =['id'];
}
