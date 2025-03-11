<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applier extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'email',
        'password',
    ];
    public function Jobs()
    {
        return $this->belongsToMany(Job::class, 'jobs_appliers', 'applier_id', 'job_id');
    }

}
