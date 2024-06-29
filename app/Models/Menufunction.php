<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menufunction extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'icon',
        'route',
        'mmodules_id',
        'sort',
        'type',
    ];
}
