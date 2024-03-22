<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingRequest extends Model
{
    protected $fillable = [
        'name',
        'place',
        'start_date',
        'start_time',
    ];
}
