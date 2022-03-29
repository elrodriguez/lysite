<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcaStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id','course_id', 'status', 'registered_until'
    ];

    protected static function newFactory()
    {
        return \Modules\Academic\Database\factories\AcaStudentFactory::new();
    }

    public function person()
    {
        return $this->belongsTo(\App\Models\Person::class,'person_id');
    }
}
