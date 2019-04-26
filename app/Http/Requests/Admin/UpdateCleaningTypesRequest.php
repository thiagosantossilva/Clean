<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCleaningTypesRequest extends FormRequest
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
            
            'title' => 'required|unique:cleaning_types,title,'.$this->route('cleaning_type'),
            'external_id' => 'max:2147483647|nullable|numeric',
        ];
    }
}
