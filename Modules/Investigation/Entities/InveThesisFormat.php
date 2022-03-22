<?php

namespace Modules\Investigation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InveThesisFormat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'school_id',
        'type_thesis',
        'normative_thesis',
    ];

    protected static function newFactory()
    {
        return \Modules\Investigation\Database\factories\InveThesisFormatsFactory::new();
    }
}
