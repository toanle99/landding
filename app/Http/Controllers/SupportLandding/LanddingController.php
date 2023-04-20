<?php

namespace App\Http\Controllers\SupportLandding;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;  
use App\Helpers\Qs;
use App\Helpers\Mk;  
use App\Models\Member; 
use App\Models\Cuahang;  
use App\Models\Hoadon;  

use App\Models\Gift; 
use Illuminate\Support\Facades\Storage;


class LanddingController extends Controller
{
    protected $user;
    public function __construct() { }

    public function index()
    {
        $thanhphos = ['An Giang','Bà Rịa-Vũng Tàu','Bạc Liêu','Bắc Giang','Bắc Kạn','Bắc Ninh','Bến Tre','Bình Dương','Bình Định','Bình Phước','Bình Thuận','Cà Mau','Cao Bằng','Cần Thơ','Đà Nẵng','Đắk Lắk','Đắk Nông','Điện Biên','Đồng Nai','Đồng Tháp','Gia Lai','Hà Giang','Hà Nam','Hà Nội','Hà Tĩnh','Hải Dương','Hải Phòng','Hậu Giang','Hòa Bình','Hưng Yên','Khánh Hòa','Kiên Giang','Kon Tum','Lai Châu','Lạng Sơn','Lào Cai','Lâm Đồng','Long An','Nam Định','Nghệ An','Ninh Bình','Ninh Thuận','Phú Thọ','Phú Yên','Quảng Bình','Quảng Nam','Quảng Ngãi','Quảng Ninh','Quảng Trị','Sóc Trăng','Sơn La','Tây Ninh','Thái Bình','Thái Nguyên','Thanh Hóa','Thừa Thiên Huế','Tiền Giang','TP Hồ Chí Minh','Trà Vinh','Tuyên Quang','Vĩnh Long','Vĩnh Phúc','Yên Bái'];
        $d['thanhphos'] = $thanhphos; 
        $cuahangs = Cuahang::all();
        $d['cuahangs'] = $cuahangs; 
        return view('pages.support_landding.frontend.index', $d);
    }

    public function store(Request $request)
    {
        
        $data = $request->all();
        
        $member = Member::where(['phone' => $data['phone']])->first(); 
        
        if(!$member){
            $member = Member::create($data); 
            return ['status' => 4, 'phone' => $member->phone, 'member_id' => $member->id, 'member_gthd' => 0, 'message' => 'Lưu hóa đơn thành công !!!' ];  
        } elseif(!isset($member->signature)) {
            $cost = Hoadon::where('member_id', $member->id)->sum('cost'); 
            return ['status' => 1, 'phone' => $member->phone, 'member_id' => $member->id, 'member_gthd' => $cost, 'message' => 'Đã tham gia điền thông tin nhưng chưa tham gia quay thưởng!']; 
        }
        return ['status' => 0, 'message' => 'Bạn đã tham gia hết chương trình này rồi !!!']; 
    }

    public function storeHoadon(Request $request)
    {
        
        $data = $request->all();
        // dd($data);
        $member = Member::find($data['member_id']);
        $cuahang = Cuahang::find($data['cuahang_id']);
        if(isset($member) && isset($cuahang) && $data['cost'] > 0) {
            $hoadon = Hoadon::create($data);
            $cost = Hoadon::where('member_id', $member->id)->sum('cost'); 
            return ['status' => 4, 'phone' => $member->phone, 'member_id' => $member->id, 'member_gthd' => $cost, 'message' => 'Thêm hóa đơn thành công !'];
        }
         
        return ['status' => 0, 'message' => 'Không thể thêm hóa đơn !!!']; 
    }

    
    public function startEvent()
    {
        return view('pages.support_landding.frontend.start-event');
    }
    
    public function eventStep2(Request $request)
    {
        // 
        $phone = $request->all()['phone'];
        // sđt đã điền form
        $member = Member::where('phone', $phone)->first();
        if($member) {
            // if(isset($member['gift_id']) && isset($member['signature'])){
            //     return back()->with('flash_error', 'Bạn đã tham gia chươn trình này rồi!');
            // }
            $url = url()->previous();
            $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();

            if($route != 'landding.startEvent') {
                return redirect()->route('landding.startEvent');     
            }
            
            $gifts = Gift::where('count','>', 0)->where('date_start','<', date('Y-m-d'))->where('date_end','>', date('Y-m-d'))->get();
            // time 18h-20h thì lấy về gift 5; 
            // comment if not 
            // $time = date('H:i:s');
            // if($time < '18:00:00' || $time > '20:00:00')
            //     $gifts = $gifts->where('id','<>', 5);
            // end

            $d['gifts'] = $gifts; 
            if($route != 'landding.startEvent') {
                return redirect()->route('landding.startEvent');     
            } 
            foreach($gifts as $gift) {
                // tách chữ thành 2 dòng
                $arr = explode (' ', $gift->content); 
                if(count($arr) > 6) {
                    array_splice( $arr, 4, 0, '\n' ); 
                    $gift->content = implode(' ', $arr);
                }elseif(count($arr) >=4){
                    array_splice( $arr, 2, 0, '\n' ); 
                    $gift->content = implode(' ', $arr);
                }
                // tìm xem quà số --5-- đã xuất hiện hôm nay chưa
                $show = 'oke';
                if($gift->id == 5){
                    $arr_shows = explode('|', $gift->shows);
                    $now = date('Y-m-d'); // ngày ? giờ 
                    if(in_array($now, $arr_shows)){ // đã xuất hiện 1 lần trông hôm nay
                        $show = 'Hôm nay đã có người nhanh tay và may mắn nhận quà này rồi!';
                    } elseif(date("H:i:s") < '18:00:00' || date("H:i:s") > '20:00:00') {
                        $show = 'Voucher này áp dụng trong thời gian (18h-20h)';
                    } 
                }
                $gift->show = $show;
                
            } 
            $d['member'] = $member;
            return view('pages.support_landding.frontend.event-step-2', $d);
            
        }
        return back()->with('flash_error', 'Số điện thoại chưa tham gia cuộc khảo sát');

    }
    
    public function signatureSave(Request $request)
    { 
        // save chuky, -- qua (18h-20h => id=5->--1) //
        $data = $request->all(); 
        $member = Member::where(['phone' => $data['phone']])->first(); 
        // dd($data);
        if($data['signature']) {

            // if($data['gift_id'] == 5) { // quà đặc biệt // xét thời gian 18-20 (22/4-27/4), chưa ai nhận
            // $arr_shows = explode('|', $gift->shows);
            // $now = date('Y-m-d'); // ngày ? giờ 
            // if(in_array($now, $arr_shows)){ // đã xuất hiện 1 lần trông hôm nay
            //     return Qs::jsonStoreOk();   
            // } else {
            //     array_push($arr_shows, $now);
            //     $gift->shows = implode('|', $arr_shows);
            // } 
            // }

            $gift = Gift::find($data['gift_id']);
            
            $signature = $data['signature'];
            $signature = str_replace('data:image/png;base64,', '', $signature);
            $signature = str_replace(' ', '+', $signature); 
            $signature = base64_decode($signature);
            $path = Qs::getMemberUploadPath().'/'.$member->id.'/signature.png';
            Storage::disk('public')->put($path, $signature, 'public');
            
            $signature_path = asset('storage/' . $path); 
            $data['signature'] = $signature_path; 
            // $member->
            $member['signature'] = $data['signature'];
            $member['gift_id'] = $data['gift_id']; 
            $member->save();
            // gift
            
            $gift->count -- ;
            $gift->save(); 
             
            // dd($gift->id .' -  -  '.$gift->count);
        }  

        // Gift::create($data);
        return Qs::jsonStoreOk();  
        
        // dd($request->all());
    }

    // 
    public function eventStep3(Request $request)
    {
        $phone = $request->all()['phone'];
        // sđt đã điền form
        $member = Member::where('phone', $phone)->first();
        if($member) {
            // if(isset($member['gift_id']) && isset($member['signature'])){
            //     return back()->with('flash_error', 'Bạn đã tham gia chươn trình này rồi!');
            // }
            $url = url()->previous();
            $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();

            if($route != 'landding.startEvent') {
                return redirect()->route('landding.startEvent');     
            }
            
            $gifts = Gift::where('count','>', 0)->where('date_start','<', date('Y-m-d'))->where('date_end','>', date('Y-m-d'))->get();
            // time 18h-20h thì lấy về gift 5; 
            // comment if not 
            // $time = date('H:i:s');
            // if($time < '18:00:00' || $time > '20:00:00')
            //     $gifts = $gifts->where('id','<>', 5);
            // end

            $d['gifts'] = $gifts; 
            if($route != 'landding.startEvent') {
                return redirect()->route('landding.startEvent');     
            } 
            foreach($gifts as $gift) {
                // tách chữ thành 2 dòng
                $arr = explode (' ', $gift->content); 
                if(count($arr) > 6) {
                    array_splice( $arr, 4, 0, '\n' ); 
                    $gift->content = implode(' ', $arr);
                }elseif(count($arr) >=4){
                    array_splice( $arr, 2, 0, '\n' ); 
                    $gift->content = implode(' ', $arr);
                }
                // tìm xem quà số --5-- đã xuất hiện hôm nay chưa
                $show = 'oke';
                if($gift->id == 5){
                    $arr_shows = explode('|', $gift->shows);
                    $now = date('Y-m-d'); // ngày ? giờ 
                    if(in_array($now, $arr_shows)){ // đã xuất hiện 1 lần trông hôm nay
                        $show = 'Hôm nay đã có người nhanh tay và may mắn nhận quà này rồi!';
                    } elseif(date("H:i:s") < '18:00:00' || date("H:i:s") > '20:00:00') {
                        $show = 'Voucher này áp dụng trong thời gian (18h-20h)';
                    } 
                }
                $gift->show = $show;
                
            } 
            $d['member'] = $member;
            return view('pages.support_landding.frontend.event-step-3', $d);
            
        }
        return back()->with('flash_error', 'Số điện thoại chưa tham gia cuộc khảo sát');

        
    }
}
