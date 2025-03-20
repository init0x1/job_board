<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobListingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'responsibilities' => 'required|string',
            'requirements' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'work_type' => 'required|in:remote,on-site,hybrid',
            'salary_min' => 'nullable|numeric',
            'salary_max' => 'nullable|numeric',
            'application_deadline' => 'required|date|after:today',
        ];
    }
}