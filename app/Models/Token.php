<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'refresh_token';

    protected $fillable = [
        'name',
        'access_token',
        'refresh_token_expire'
    ];
    use HasFactory;
}
