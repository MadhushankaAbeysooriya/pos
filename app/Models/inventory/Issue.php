<?php

namespace App\Models\inventory;

use App\Models\master\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Issue extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'purchases';
    protected $fillable = [
        'reference_no',
        'issue_date',
        'sub_total',
        'discount',
        'total',
        'issue_location_id',
        'created_user_id',
        'location_id',
        'status',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class,'location_id','id');
    }
}
