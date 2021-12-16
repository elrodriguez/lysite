<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcaContent extends Model
{
    use HasFactory;

    protected $fillable = [
            'section_id',
            'content_type_id',
            'content_url',
            'original_name',
            'status',
            'count',
            'created_by',
            'updated_by'
    ];

    protected static function newFactory()
    {
        return \Modules\Academic\Database\factories\AcaContentFactory::new();
    }
}
