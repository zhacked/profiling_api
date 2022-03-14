<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Education extends Model
{
    protected $table = 'educations';

    use HasFactory, UsesUuid, SoftDeletes;

    protected $fillable = [
        'name',
    ];

   
}
