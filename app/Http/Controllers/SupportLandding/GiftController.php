<?php

namespace App\Http\Controllers\SupportLandding;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Landding\GiftReq;   
use App\Helpers\Qs;
use App\Helpers\Mk;  
use App\Models\Gift; 


class GiftController extends Controller
{
    protected $user;
    public function __construct() { 
    }


    public function startEvent()
    {
        return view('pages.support_landding.frontend.start-event');
    }
    
    public function eventStep2()
    {

        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName(); 
        
        return view('pages.support_landding.frontend.event-step-2');
    }

    public function index()
    {   
        $gifts = Gift::all();
        $d['gifts'] = $gifts; 
        return view('pages.support_landding.gift.index', $d);
    }
    
    public function store(GiftReq $request)
    { 
        if(Qs::userIsTeamSAT()){
            $data = $request->all(); 
            $sr_id = Gift::orderBy('id', 'desc')->first()->id + 1;
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $f = Qs::getFileMetaData($image);
                
                $f['path'] = $image->storeAs(Qs::getGiftUploadPath().'/'.$sr_id, $f['name']);
                $image_path = asset('storage/' . $f['path']); 
                $data['image'] = $image_path;  
            }  


            Gift::create($data);
            return Qs::jsonStoreOk(); 
        }
        return Qs::goWithDanger();
    }

    public function edit($sr_id)
    { 
        if(!$sr_id){return Qs::goWithDanger();}
        if(Qs::userIsTeamSAT()){
            $data['gift'] = Gift::where(['id' => $sr_id])->first(); 
            return view('pages.support_landding.gift.edit', $data);
        }
    }

    public function update(GiftReq $req, $sr_id)
    {
        $sr_id = Qs::decodeHash($sr_id);
        if(!$sr_id){return Qs::goWithDanger();} 

        $data = $req->all();
        $data['date_start'] = date('Y-m-d', strtotime($data['date_start']));
        $data['date_end'] = date('Y-m-d', strtotime($data['date_end']));
        
        // dd($data);
        if($req->hasFile('image')) {
            $image = $req->file('image');
            $f = Qs::getFileMetaData($image);
            
            $f['path'] = $image->storeAs(Qs::getGiftUploadPath().'/'.$sr_id, $f['name']);
            $image_path = asset('storage/' . $f['path']); 
            $data['image'] = $image_path;  
        }  
        
        if(Qs::userIsTeamSAT()){
            $gift = Gift::where(['id' => $sr_id])->first(); 
            Gift::find($sr_id)->update($data); 
            return Qs::jsonUpdateOk();
        }
        return Qs::goWithDanger();
    }
    
}
