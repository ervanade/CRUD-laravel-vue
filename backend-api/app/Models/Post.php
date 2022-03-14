<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Menggunakan $fillable untuk massAsignment di laravel pada fungsi store/create dan update dicontroller 
    protected $fillable = ['title', 'content'];
}
