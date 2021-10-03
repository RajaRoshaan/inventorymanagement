<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';
    
    protected $fillable = [
        'name',
        'email',
        'cnic',
        'department_id'
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
