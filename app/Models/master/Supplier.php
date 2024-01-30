<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'suppliers';
    protected $fillable = [
        'name',
        'primary_contact',      
        'secondary_contact',      
        'address',      
        'reg_no',      
        'vat_no',      
        'status',      
        'account_no',      
    ];

}
