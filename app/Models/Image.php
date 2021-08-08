<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory, LocaleTrait;
    protected $guarded = [''];
    protected $localeStrings = ['caption','name'];

    public function imagable()
    {
        return $this->morphTo();
    }

}
