<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcaStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id','course_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Academic\Database\factories\AcaStudentFactory::new();
    }
}
