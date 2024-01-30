<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'measurements';
    protected $fillable = [
        'name',        
    ];
}
