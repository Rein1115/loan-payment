<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menumodule extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'icon', 'route', 'sort', 'type'];
}
