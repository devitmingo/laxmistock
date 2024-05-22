<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class party extends Model
{
    use HasFactory;
    protected $fillable = ['name','mobile','address','opening_balance','opening_balance_type','supplier','customer','status'];

    public function payment() {
        return $this->hasMany(Payment::class, 'id', 'party_id');
    }
}
