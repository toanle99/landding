<?php

namespace App\Http\Controllers\SupportLandding;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Landding\GiftReq;   
use App\Helpers\Qs;
use App\Helpers\Mk;  
use App\Models\Gift; 
use App\Models\Member;
use App\Models\Hoadon;

class MemberController extends Controller
{
    protected $user;
    public function __construct() { 
    }
    // name, dob, gender, phone, thanhpho, quan, pttt, bietct, pttttm, cuahang, gthd, 

    public function index()
    {   
        $members = Member::all();
        $d['members'] = $members; 
        $gifts = Gift::all();
        $d['gifts'] = $gifts; 
        foreach($members as $member){
            $cost = Hoadon::where('member_id', $member->id)->sum('cost'); 
            $member->cost = $cost;
        }
        return view('pages.support_landding.member.index', $d);
    }
    
    public function store(MemberReq $request)
    { 
        if(Qs::userIsTeamSAT()){
            Gift::create($request->all());
            return Qs::jsonStoreOk(); 
        }
        return Qs::goWithDanger();
    }

    public function edit($sr_id)
    { 
        if(!$sr_id){return Qs::goWithDanger();}
        if(Qs::userIsTeamSAT()){
            $data['gift'] = Gift::where(['id' => $sr_id])->first(); 
            return view('pages.support_landding.member.edit', $data);
        }
    }

    public function update(MemberReq $req, $sr_id)
    {
        $sr_id = Qs::decodeHash($sr_id);
        if(!$sr_id){return Qs::goWithDanger();}
        if(Qs::userIsTeamSAT()){
            $gift = Gift::where(['id' => $sr_id])->first(); 
            Gift::find($sr_id)->update($req->all()); 
            return Qs::jsonUpdateOk();
        }
        return Qs::goWithDanger();
    }
    
}
