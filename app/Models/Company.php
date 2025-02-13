<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use App\Models\Job;


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
        'dateOfCreation',
        'aboutus',
        'logo',
        'website',
        'phoneNumber',
        'commercialRegister',
        'isAccepted',
        'jobsNumber',
        'location',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($company) {
            if ($company->logo) {
                Storage::disk('logos')->delete($company->logo);
            }

            if ($company->commercialRegister) {
                Storage::disk('public')->delete($company->commercialRegister);
            }

            $companyFolder = 'records/' . $company->id;
            if (Storage::disk('public')->exists($companyFolder)) {
                Storage::disk('public')->deleteDirectory($companyFolder);
            }
        });
    }
    public function jobs(){
        return $this->hasMany(Job::class);
    }
}