<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jobs_appliers extends Model
{
    use HasFactory;
    protected $fillable = [
        "applier_id",
        "job_id",
    ] ;
}
