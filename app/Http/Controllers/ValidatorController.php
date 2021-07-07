<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\HarvesterService;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\Input;
use App\Services\XMLService;

class ValidatorController extends Controller
{
    private $harvesterService;
    private $XMLService;

    public function __construct(){
        $this->harvesterService = HarvesterService::getInstance();
        $this->XMLService = XMLService::getInstance();
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

    public function formatXML(Request $request) {
        try {
            $xml = $request->input('---');
            $this->XMLService->validateXML($xml);
        } catch(Exception $e) {
            Log::error($e->getMessage());
        }

        return view('welcome');
    }
}
