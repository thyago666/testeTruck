<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
    use HasFactory;
    protected $table = 'historic';
    protected $fillable = [
        'status',
        'time'
    ];
}
