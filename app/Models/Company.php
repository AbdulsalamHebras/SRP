<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'email',
        'password',
        'jobField',
        'mission',
        'vision',
        'dataOfCreation',
        'aboutus',
        'logo',
        'phoneNumber',
        'website',
        'commercialRegister',
        'isAccepted',
        'jobsNumber'
    ];
}