<?php

namespace App\Models;

use App\Services\Traits\ImageHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportVehcile extends Model
{
    use HasFactory, ImageHelpers, ModelHelper;
    public $table = 'report_vehicle';
    public $guarded = [''];

    public function report() {
        return $this->belongsTo(Report::class);
    }

    public function vehicle() {
        return $this->belongsTo(Vehicle::class);
    }
}

