<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'inventory_id',
        'value'
    ];

    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }
}
