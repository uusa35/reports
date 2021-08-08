<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, ModelHelper;

    protected $guarded = ['is_admin'];

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
        return $this->belongsTo(ReportType::class, 'report_type_id');
    }

    public function getIsNormalUserAttribute()
    {
        return !$this->is_officer && !$this->is_admin;
    }

    public function governate()
    {
        return $this->belongsTo(Governate::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function getUserTypeAttribute()
    {
        return $this->is_admin ? trans('general.admin') : ($this->is_officer ? trans('general.officer') : trans('general.user'));
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->father_name;
    }

    public function scopeOfficers()
    {
        return $this->where(['is_officer' => true]);
    }

    public function scopeCivilians()
    {
        return $this->where(['is_officer' => false]);
    }
}
