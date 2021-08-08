<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory, ModelHelper, LocaleTrait;
    protected $localeStrings = ['name'];

    public function users() {
        return $this->hasMany(User::class);
    }
}
