<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    use HasFactory;


    protected $fillable=['name','status'];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function purchaseDetails() {
        return $this->hasMany(PurchaseDetail::class, 'id', 'unit_id');
    }

}
