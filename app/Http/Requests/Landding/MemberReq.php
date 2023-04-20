<?php

namespace App\Http\Requests\Landding;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\Qs;

class MemberReq extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required|string', 
            'dob'       => 'required|string',
            'gender'    => 'required|string',  
            'phone'     => 'required|string', 
            'thanhpho'  => 'required|string', 
            'quan'      => 'required|string',
            'pttt'      => 'required|string',  
            'bietct'    => 'required|string',  
            'pttttm'    => 'required|string',  
            'cuahang'   => 'required|string', 
            'gthd'      => 'required|string',  
        ];
    }

    public function attributes()
    {
        return  [ 
        ];
    }
 
}
