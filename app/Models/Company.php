<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    
    protected $fillable =  ['name','ownerName','mobile','mobile2','email','email2','panNo','gst','gst','openingBal','date','address'];

        public function getDateAttribute($value){
        if($value !=''){
            return \Carbon\Carbon::parse($value)->format('d-m-Y');
        }}
    
        public function setDateAttribute($value){
          if($value !=''){
            return $this->attributes['date'] =\Carbon\Carbon::parse($value)->format('Y-m-d');
        }}

}
