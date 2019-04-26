<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCleansFeedbacksRequest extends FormRequest
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
            
            'clean_id' => 'required|unique:cleans_feedbacks,clean_id,'.$this->route('cleans_feedback'),
        ];
    }
}
