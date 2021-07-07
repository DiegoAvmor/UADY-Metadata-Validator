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
            $url = $request->input('urlXML');
            $data = $this->harvesterService->harvest($url);
            return view('validator', ['data' => $data]);
        } catch (Exception $e) {
            return back()->withErrors('Failed', $e->getMessage()); 
        }
    }

    public function validateXML(Request $request){
        try { 
            $xmlInput = $request->query('xmlInput');
            //TODO: Implement xml parse and validation
            return back();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->withErrors('Failed', $e->getMessage()); 
        }
    }

}
