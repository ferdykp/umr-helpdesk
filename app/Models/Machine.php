<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Machine extends Model
{
    use HasFactory;

    protected $table = 'machine';
    protected $fillable = [
        'machine_name',
        // 'machine_location'
    ];
}