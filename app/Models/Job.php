<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory, UsesUuid, SoftDeletes;

    protected $fillable = [
        'industry_id',
        'department_id',
        'job_level_id',
        'job_type_id',
        'education_id',
        'job_title',
        'contract',
        'description',
        'minimum_requirements',
        'min_salary',
        'max_salary',
        'location',
        'perks_benefits',
        'no_of_vacancy'  
    ];

    public function industry (){
        return $this->belongsTo('App\Models\Industry', 'industry_id');
    }

    public function department (){
        return $this->belongsTo('App\Models\Department', 'department_id');
    }

    public function job_level(){
        return $this->belongsTo('App\Models\JobLevel', 'job_level_id');
    }

    public function job_type (){
        return $this->belongsTo('App\Models\Jobtype', 'job_type_id');
    }

    public function education (){
        return $this->belongsTo('App\Models\Education', 'education_id');
    }

}
