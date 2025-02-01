<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
abstract class Controller extends BaseController // يجب أن يرث BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}