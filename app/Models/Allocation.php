<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Allocation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'office_id',
        'person_id',
        'inventory_id',
        'allocation_date',
        'deallocated',
        'deallocation_date'
    ];

    public function office(){
        return $this->belongsTo(Office::class);
    }

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }
}
