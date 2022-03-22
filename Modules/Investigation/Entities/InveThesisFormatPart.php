<?php

namespace Modules\Investigation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InveThesisFormatPart extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'information',
        'number_order',
        'content_id',
        'thesis_format_id',
        'belongs',
        'state'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Investigation\Database\factories\InveThesiFormatPartFactory::new();
    }

    public function inve_thesis_format()
    {
        return $this->belongsTo(InveThesisFormat::class, 'thesis_format_id');
    }
}
