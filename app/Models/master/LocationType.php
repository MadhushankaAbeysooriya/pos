<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocationType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'location_types';
    protected $fillable = [
        'name',        
    ];

    
}
