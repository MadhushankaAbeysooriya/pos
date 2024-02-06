<?php

namespace App\Models\inventory;

use App\Models\inventory\Issue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IssueItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'purchases';
    protected $fillable = [
        'issue_id',
        'item_id',
        'qty',
        'unit_price',
        'discount',
        'amount',
        'unit_selling_price',
        'exp_date',
    ];

    public function issue()
    {
        return $this->belongsTo(Issue::class,'issue_id','id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class,'item_id','id');
    }
}
