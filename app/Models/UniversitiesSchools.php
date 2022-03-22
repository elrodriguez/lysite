<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversitiesSchools extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'university_id'
    ];

    public function universities()
    {
        return $this->belongsTo(Universities::class,'university_id');
    }
}
