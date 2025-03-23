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
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'application_deadline' => 'required|date|after:today',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'The job title is required.',
            'title.max' => 'The job title may not be greater than 255 characters.',
            'description.required' => 'The job description is required.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'The selected category is invalid.',
            'location_id.required' => 'Please select a location.',
            'location_id.exists' => 'The selected location is invalid.',
            'work_type.required' => 'Please select a work type.',
            'work_type.in' => 'The selected work type is invalid.',
            'salary_min.numeric' => 'The minimum salary must be a number.',
            'salary_max.numeric' => 'The maximum salary must be a number.',
            'application_deadline.date' => 'The application deadline must be a valid date.',
            'application_deadline.after' => 'The application deadline must be a future date.',
        ];
    }
}
