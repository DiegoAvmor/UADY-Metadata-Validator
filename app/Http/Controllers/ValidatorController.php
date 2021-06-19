<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\HarvesterService;
use Illuminate\Support\Facades\Log;

class ValidatorController extends Controller
{
    private $harvesterService;

    public function __construct(){
        $this->harvesterService = HarvesterService::getInstance();
    }

    public function harvestURL(Request $request){
        try {
            $this->harvesterService->harvest('http://redi.uady.mx/oai/request');
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return view('welcome');
    }

}
