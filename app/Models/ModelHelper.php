<?php

namespace App\Models;

trait ModelHelper
{
    public function scopeActive($q)
    {
        return $q->where('active', true);
    }

    public function getImageLargeLinkAttribute()
    {
        return asset(env('LARGE') . $this->image);
    }

    public function getImageMediumLinkAttribute()
    {
        return asset(env('MEDIUM') . $this->image);
    }

    public function getImageThumbLinkAttribute()
    {
        return asset(env('THUMBNAIL') .$this->image);
    }
}
