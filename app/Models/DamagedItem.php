<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DamagedItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'inventory_id',
        'description',
        'status',
        'repaired',
        'allocation_id'
    ];

    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }

    public function allocation(){
        return $this->belongsTo(Allocation::class);
    }
}
