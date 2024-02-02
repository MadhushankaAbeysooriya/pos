<?php

namespace App\Models\master;

use App\Models\master\Brand;
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
        'barcode',
        'item_category_id',
        'measurement_id',
        'brand_id',
        'rol',
        'product_image',
        'deleted_at',
    ];

    public function itemcategory()
    {
        return $this->belongsTo(ItemCategory::class,'item_category_id','id');
    }

    public function measurement()
    {
        return $this->belongsTo(Measurement::class,'measurement_id','id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }
}
