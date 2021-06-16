<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, ModelHelper;

    protected $guarded = [''];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    // Reports are submitted by users
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    // Records are reports assigned to an officer
    public function records()
    {
        return $this->hasMany(Report::class, 'officer_id');
    }

    // Each Officer has ReportType Speciality (Murder .. Fire .. and so on)
    public function speciality()
    {
        return $this->belongsTo(ReportType::class,'report_type_id');
    }
}
