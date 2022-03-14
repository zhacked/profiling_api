<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Scheduler extends Model
{
    use HasFactory, UsesUuid, SoftDeletes;

    protected $fillable = [
        'interview_date',
        'interview_start',
        'interview_end',
        'interview_link',
        'email',
        'name',
        'position',
        'address',
        'note'
    ];
}
