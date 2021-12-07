<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcaSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Academic\Database\factories\AcaSectionFactory::new();
    }
}
