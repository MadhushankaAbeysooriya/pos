<?php

namespace App\Models\master;

use App\Models\master\LocationType;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'locations';
    protected $fillable = [
        'name',
        'location_type_id',
        'deleted_at'
    ];

    public function locationtype()
    {
        return $this->belongsTo(LocationType::class,'location_type_id','id');
    }

}
