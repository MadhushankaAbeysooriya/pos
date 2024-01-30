<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemCategory extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'item_categories';
    protected $fillable = [
        'name',
        'deleted_at'
    ];
}
