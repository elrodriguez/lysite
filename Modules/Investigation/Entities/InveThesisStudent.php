<?php

namespace Modules\Investigation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InveThesisStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'short_name',
        'title',
        'student_id',
        'person_id',
        'user_id',
        'university_id',
        'school_id',
        'format_id',
        'state'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Investigation\Database\factories\InveThesisStudentFactory::new();
    }
}
