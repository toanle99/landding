<?php

namespace App\Http\Controllers;

use App\Helpers\Qs;
use App\Repositories\UserRepo;
use App\Models\StudentWritte;
use App\Models\StudentRecord;
use App\Models\WritteType;
use App\Repositories\MyClassRepo;
use App\Repositories\StudentRepo;
use Illuminate\Support\Facades\Auth;
use App\Models\Gift; 
use App\Models\Member;

class HomeController extends Controller
{
    protected $user;
    public function __construct(UserRepo $user, StudentRepo $student, MyClassRepo $my_class)
    {
        $this->user = $user;
        $this->student = $student;
        $this->my_class = $my_class;
    }


    public function index()
    {
        return view('pages.other.privacy_policy');
    }

    public function privacy_policy()
    {
        $data['app_name'] = config('app.name');
        $data['app_url'] = config('app.url');
        $data['contact_phone'] = Qs::getSetting('phone');
        return view('pages.other.privacy_policy', $data);
    }

    public function terms_of_use()
    {
        $data['app_name'] = config('app.name');
        $data['app_url'] = config('app.url');
        $data['contact_phone'] = Qs::getSetting('phone');
        return view('pages.other.terms_of_use', $data);
    }

    public function dashboard()
    {
         
        $user = Auth::user();
        $d=[]; 
        
        if(Qs::userIsTeamSAT()){
            $members = Member::all();
            $d['members'] = $members; 
            $gifts = Gift::all();
            $d['gifts'] = $gifts; 
        }
          
        return view('pages.support_team.dashboard', $d);
    }

    public function report()
    {
        $gxps = StudentWritte::orderbyDesc('date_at')->get();
        $user = Auth::user();
        $d=[];

        $ut  = WritteType::orderby('level')->get(); 
        
        if(Qs::userIsTeamSAT()){
            $d['users'] = $this->user->getAll();


            $ut = $ut->whereIn('level', [2]);
            $gxps = $gxps->whereIn('status', [2]);
            if(Qs::userIsTeacher()){
                // class of teacher 
                $cl_tcs =  $this->my_class->findClassByTeacher($user->id);
                $student = Array(); 
                $students = Array();
                // if(count($cl_tcs) == 0)    
                foreach($cl_tcs as $cl_tc){
                    $st =$this->student->findStudentIdsByClasses($cl_tc->id); 
                    array_push($students, $st);//
                    $student = array_merge($student, $st);        
                    
                }

                $gxps = $gxps->whereIn('student_record_id', $student); 
                $d['cl_tcs'] = $cl_tcs;
                $d['students'] = $students;
            }
            $d['ut'] = $ut; 
        }
        if(Qs::userIsStudent()){
            // $student = StudentRecord::where('user_id',$user->id)->first();
            $student = $this->student->getRecord(['user_id' => $user->id])->first();

            $gxps = $gxps->where('student_record_id', $student->id);
        }
        if(Qs::userIsParent()){
            $student_ids = $this->student->getRecordIds(['my_parent_id' => Auth::user()->id]);
            // $student = $this->student->getRecord(['user_id' => $user->id])->first();
            $students = $this->student->getRecord(['my_parent_id' => Auth::user()->id])->get();
            $gxps = $gxps->whereIn('student_record_id', $student_ids);
            
            $d['students'] = $students;
        }  
        $d['gxps'] = $gxps; 




         
        // dd($students);

        return view('pages.support_team.report', $d);
    }
}
