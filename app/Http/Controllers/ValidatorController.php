<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\HarvesterService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;


class ValidatorController extends Controller
{
    private $harvesterService;

    public function __construct(){
        $this->harvesterService = HarvesterService::getInstance();
    }

    public function harvestURL(Request $request){
        try {
            return redirect('validator'); 
            $url = $request->input('urlXML');
            $data = $this->harvesterService->harvest($url);
            return view('validator', ['data' => $data]);
        } catch (Exception $e) {
            return back()->withErrors('Failed', $e->getMessage()); 
        }
    }

}
