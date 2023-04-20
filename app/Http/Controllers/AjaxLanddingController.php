<?php

namespace App\Http\Controllers\SupportLandding;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;  
use App\Helpers\Qs;
use App\Helpers\Mk;  
use App\Models\Member; 
 
class LanddingController extends Controller
{
    protected $user;
    public function __construct() { }

    public function index()
    {
        return view('pages.support_landding.frontend.index');
    }

    public function store(Request $request)
    {
        
        $data = $request->all();
        $member = Member::where(['phone' => $data['phone']])->first(); 
        
        if(!$member){
            return ['status' => 4, 'message' => 'oke !!!'];  
            return Qs::jsonStoreOk(); 
        }
        return ['status' => 0, 'message' => 'tồn tại !!!']; 
    }
    
    public function startEvent()
    {
        return view('pages.support_landding.frontend.start-event');
    }
    
    public function eventStep2()
    {

        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();

        // if($route != 'landding.startEvent') {
        //     return redirect()->route('landding.startEvent');     
        // }
        
        return view('pages.support_landding.frontend.event-step-2');
    }
}
