<?php

namespace App\Models;

trait ModelHelper
{
    public function scopeActive($q)
    {
        return $q->where('active', true);
    }

    public function getImageLargeLinkAttribute($element = 'image')
    {
        return asset(env('LARGE') . $this->{$element});
    }

    public function getImageMediumLinkAttribute($element = 'image')
    {
        return asset(env('MEDIUM') . $this->{$element});
    }

    public function getImageThumbLinkAttribute($element = 'image')
    {
        return asset(env('THUMBNAIL') . $this->{$element});
    }
}
