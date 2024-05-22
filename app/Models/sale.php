<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'party_id',
        'user_id',
        'session_id'
    ];
    
    public function party() {
        return $this->belongsTo(party::class, 'party_id', 'id');
    }
}
