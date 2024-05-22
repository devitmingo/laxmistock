<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','price','category_id','sub_category_id','unit_id','status','minStock','inStock'];

    public function category()
    {
        return $this->belongsTo(categories::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(subCategory::class);
    }


    public function unit()
    {
        return $this->belongsTo(unit::class);
    }

    public function purchaseDetails() {
        return $this->hasMany(PurchaseDetail::class, 'id', 'product_id');
    }

    
}
