<?php

namespace App\Models\master;

use App\Models\User;
use App\Models\master\Location;
use App\Models\master\LocationType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'locations';
    protected $fillable = [
        'name',
        'location_type_id',
        'deleted_at',
        'under_cmd_location_id'
    ];

    public function locationtype()
    {
        return $this->belongsTo(LocationType::class,'location_type_id','id');
    }

    public function undercmdlocation()
    {
        return $this->belongsTo(Location::class,'under_cmd_location_id','id');
    }

}
