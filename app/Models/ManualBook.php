<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualBook extends Model
{
    use HasFactory;
    protected $table = 'manual_books';
    protected $fillable = ['document_name', 'document_path'];
}
