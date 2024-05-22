<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    use HasFactory;

    protected $fillable=['name','status'];

    public function subCategory()
    {
        return $this->hasMany(subCategory::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
