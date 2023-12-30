<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory,softDeletes;

    protected $fillable = [
    	'name', 
    	'description',
    	'price',
    	'auther'
    ];
}
