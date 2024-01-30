<?php

namespace App\Models\master;

use App\Models\master\Measurement;
use App\Models\master\ItemCategory;
use App\Models\master\RationCategory;
use Illuminate\Database\Eloquent\Model;
use App\Models\master\RationSubCategory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'items';
    protected $fillable = [
        'name',
        'item_category_id',
        'ration_sub_category_id',
        'measurement_id',
        'deleted_at',
        'is_vat',
    ];

    public function itemcategory()
    {
        return $this->belongsTo(ItemCategory::class,'item_category_id','id');
    }

    public function measurement()
    {
        return $this->belongsTo(Measurement::class,'measurement_id','id');
    }

    // public function rationcategory()
    // {
    //     return $this->belongsTo(RationCategory::class,'ration_category_id','id');
    // }

    public function rationsubcategory()
    {
        return $this->belongsTo(RationSubCategory::class,'ration_sub_category_id','id');
    }
}
