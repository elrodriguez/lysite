<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcaCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'course_image',
        'created_by',
        'updated_by'
    ];

    protected static function newFactory()
    {
        return \Modules\Academic\Database\factories\AcaCourseFactory::new();
    }
}
