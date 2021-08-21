<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory, ModelHelper;

    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reports()
    {
        return $this->belongsToMany(Report::class, 'report_vehicle')->withPivot('image', 'path', 'driver_license',
            'injury_name_1',
            'injured_1',
            'injury_name_2',
            'injured_2',
            'injury_name_3',
            'injured_3',
            'notes');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imagable');
    }
}
