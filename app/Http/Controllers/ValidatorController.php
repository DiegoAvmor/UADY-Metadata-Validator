<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\HarvesterService;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\Input;

class ValidatorController extends Controller
{
    private $harvesterService;

    public function __construct(){
        $this->harvesterService = HarvesterService::getInstance();
    }

    public function harvestURL(Request $request){
        try {
            $url = $request->input('urlXML');
            $this->harvesterService->harvest($url);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return view('welcome');
    }

}
