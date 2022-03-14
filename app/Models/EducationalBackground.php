<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EducationalBackground extends Model
{
    use HasFactory, UsesUuid, SoftDeletes;
    protected $fillable = [
        'user_id',
        'education_id',
        'study_from_month',
        'study_from_year',
        'study_to_month',
        'study_to_year',
        'degree'
    ];
}
