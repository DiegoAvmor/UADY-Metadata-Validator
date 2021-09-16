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
            $data = $this->harvesterService->harvest($url);
            
            return view('validator', ['data' => $data]);
        } catch (Exception $e) {
            return back()->withErrors('Failed', $e->getMessage()); 
        }
    }

    public function validateXML(Request $request){
        try { 
            $xmlInput = $request->input('xmlInput');
            $response = $this->XMLService->validateXML($xmlInput);

            if(is_string($response)) {
                return view('validator', ['error' => $response]);
            }

            return view('validator', ['data' => $response]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->withErrors('Failed', $e->getMessage()); 
        }
    }
}
