<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'industry_id'    => 'required',
            'department_id'  => 'required',
            'job_level_id'   => 'required',
            'job_type_id'    => 'required',
            'education_id'   => 'required',
            'job_title'      => 'required',
            'contract'       => 'required',
            'description'    => 'required',
            'minimum_requirements' => 'required',
            'min_salary'     => 'required',
            'location'      => 'required',
            'perks_benefits' => 'required',
            'no_of_vacancy'  => 'required',
        ];
    }
}
