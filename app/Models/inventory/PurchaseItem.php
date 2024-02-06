<?php

namespace App\Models\inventory;

use App\Models\master\Item;
use App\Models\inventory\Purchase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'purchase_items';
    protected $fillable = [
        'purchase_id',
        'item_id',
        'qty',
        'avl_qty',
        'unit_price',
        'discount',
        'amount',
        'unit_selling_price',
        'exp_date',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class,'purchase_id','id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class,'item_id','id');
    }
}
