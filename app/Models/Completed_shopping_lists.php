<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Completed_shopping_lists extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'user_id'
    ];

    protected $guarded =['id'];
}
