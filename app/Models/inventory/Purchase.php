<?php

namespace App\Models\inventory;

use App\Models\User;
use App\Models\master\Location;
use App\Models\master\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'purchases';
    protected $fillable = [
        'reference_no',
        'purchase_date',
        'sub_total',
        'discount',
        'total',
        'supplier_id',
        'created_user_id',
        'location_id',
        'status',
        'type',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }

    public function createuser()
    {
        return $this->belongsTo(User::class,'created_user_id','id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class,'location_id','id');
    }

}
