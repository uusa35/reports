<?php

namespace App\Http\Controllers;

use App\Services\Traits\ImageHelpers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ImageHelpers;
    const TAKE_MIN = 10;
    const TAKE_MED = 20;
    const TAKE_MAX = 30;
}
