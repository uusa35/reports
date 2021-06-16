<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportType extends Model
{
    use HasFactory, ModelHelper;
    protected $guarded = [''];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function officers() {
        return $this->hasMany(User::class);
    }
}
