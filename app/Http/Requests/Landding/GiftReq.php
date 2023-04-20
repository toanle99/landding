<?php

namespace App\Http\Requests\Landding;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\Qs;

class GiftReq extends FormRequest
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
            'brand' => 'required|string', 
            'type' => 'required|string',
            'count' => 'required|nullable',  
            'content' => 'required|string', 
        ];
    }

    public function attributes()
    {
        return  [ 
        ];
    }
 
}
