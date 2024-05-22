<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable =['party_id','payAmount','payType','payDate','note','receiptNo','type','session_id','user_id','receiptSn','page'];

    public function getPayDateAttribute($value){
        if($value !=''){
            return \Carbon\Carbon::parse($value)->format('d-m-Y');
        }}
    
         public function setPayDateAttribute($value){
        if($value !=''){
            return $this->attributes['payDate'] =\Carbon\Carbon::parse($value)->format('Y-m-d');
        }}

        public function party() {
            return $this->belongsTo(party::class, 'party_id', 'id');
        }

}
