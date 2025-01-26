<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Company extends Authenticatable
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
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
