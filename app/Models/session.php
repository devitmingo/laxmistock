<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class session extends Model
{
    use HasFactory;

    protected $fillable=['name','startDate','endDate','status','saleInvoicePrefix','QuatationInvoicePrefix','CPPrefix','SPPrefix'];

        public function getStartdateAttribute($value){
            if($value !=''){
            return \Carbon\Carbon::parse($value)->format('d-m-Y');
        }}

        public function getEnddateAttribute($value){
        if($value !=''){
            return \Carbon\Carbon::parse($value)->format('d-m-Y');
        }}
    
         public function setStartdateAttribute($value){
        if($value !=''){
            return $this->attributes['startdate'] =\Carbon\Carbon::parse($value)->format('Y-m-d');
        }}
    
        public function setEnddateAttribute($value){
        if($value !=''){
            return $this->attributes['enddate'] =\Carbon\Carbon::parse($value)->format('Y-m-d');
        }}
}
