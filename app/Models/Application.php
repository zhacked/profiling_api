<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory, UsesUuid, SoftDeletes;
    protected $fillable = [
        'logo',
        'job_title',
        'company_name',
        //'posted' -> it will the created_at
        'apply_before',
        'recruiter_id', //fix (di ko alam saan kukunin yung recuiter id)
        'location_id', 
        'salary', //base on post
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'recruiter_id');
    }
   
}   

