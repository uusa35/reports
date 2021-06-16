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
        return $this->belongsTo(User::class,'user_id');
    }

    public function officer()
    {
        return $this->belongsTo(User::class,'officer_id');
    }

    public function type() {
        return $this->belongsTo(ReportType::class,'report_type_id');
    }

    public function vehicles() {
        return $this->belongsToMany(Vehicle::class);
    }
}
