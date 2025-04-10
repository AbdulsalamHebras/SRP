<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Applier extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'name', 'email', 'password', 'phoneNumber', 'city', 'address', 'age',
        'DOB', 'degree', 'specialization', 'photo', 'CVfile','graduationDate','gender','languages'
    ];
    public function Jobs()
    {
        return $this->belongsToMany(Job::class, 'jobs_appliers', 'applier_id', 'job_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }



}
