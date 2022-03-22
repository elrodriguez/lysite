<?php

namespace Modules\Investigation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InveThesisFormat extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Investigation\Database\factories\InveThesisFormatsFactory::new();
    }
    public function inve_Thesis_format_part()
    {
        return $this->hasMany(InveThesisFormatPart::class,'thesis_format_id');
    }
    public function universities_schools()
    {
        return $this->belongsTo(UniversitiesSchools::class, 'school_id');
    }
}
