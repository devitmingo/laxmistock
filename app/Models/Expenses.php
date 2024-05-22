<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;

    protected $fillable = ['head_id','amount','date','payType','note','insertType','session_id','user_id','page'];
   
    public function head() {
        return $this->belongsTo(Head::class, 'head_id', 'id');
    }
}
