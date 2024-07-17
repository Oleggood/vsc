<?php

namespace App\Http\Controllers;

use App\Services\Assignment\CrimeService;

class BaseController extends Controller
{
    public $crimeService;

    public function __construct(CrimeService $crimeService)
    {
        $this->crimeService = $crimeService;
    }

}
