<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'logo' =>'required',
            'job_title' => 'required',
            'company_name' => 'required',
            'apply_before' => 'required',
            'recruiter_id' => 'required', 
            'location_id' => 'required', 
            'salary' => 'required', 
        ];
    }
}
