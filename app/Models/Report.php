<?php

namespace App\Models;

use App\Services\Traits\ImageHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory, ModelHelper;

    public $guarded = [''];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function officer()
    {
        return $this->belongsTo(User::class, 'officer_id');
    }

    public function type()
    {
        return $this->belongsTo(ReportType::class, 'report_type_id');
    }

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'report_vehicle')->withPivot('image', 'path',
            'driver_license',
            'injury_civil_id',
            'injury_civil_id_1',
            'injury_name_1',
            'injured_1',
            'injury_civil_id_2',
            'injury_name_2',
            'injured_2',
            'injury_civil_id_3',
            'injury_name_3',
            'injured_3',
            'building_no',
            'notes',
            'description',
            'traffic_offences'
        );
    }

    public function governate()
    {
        return $this->belongsTo(Governate::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imagable');
    }
}
