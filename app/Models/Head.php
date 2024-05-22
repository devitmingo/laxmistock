<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Head extends Model
{
    use HasFactory;

    protected $fillable = ['name','status'];

    public function expenses() {
        return $this->hasMany(Expenses::class, 'id', 'head_id');
    }
}
