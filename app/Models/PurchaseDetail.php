<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'product_id',
        'unit_id',
        'qty',
        'buyRate',
        'saleRate',
        'total'
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function unit() {
        return $this->belongsTo(unit::class, 'unit_id', 'id');
    }

}
