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

    public function reports() {
        return $this->belongsToMany(Report::class,'report_vehicle');
    }
}
