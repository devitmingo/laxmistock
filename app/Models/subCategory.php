<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subCategory extends Model
{
    use HasFactory;


    protected $fillable = ['name','category_id','status'];

    public function category()
    {
        return $this->belongsTo(categories::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
