<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable=[
        'jobName',
        'description',
        'jobType',
        'minSalary',
        'maxSalary',
        'currency',
        'category_id',
        'company_id',
        'requirements',
        'expirationDate',
        'location',
        'reqGrade'

    ];
    public function company()
        {
            return $this->belongsTo(Company::class);
        }
}