<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCleansRequest extends FormRequest
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
            'external_id' => 'max:2147483647|nullable|numeric',
            'payment_id' => 'max:2147483647|nullable|numeric',
            'address_type_id' => 'required',
            'clean_type_id' => 'required',
            'clean_category_id' => 'required',
            'client_id' => 'required',
            'status_id' => 'required',
            'qt_bedrooms' => 'max:2147483647|required|numeric',
            'qt_bathrooms' => 'max:2147483647|required|numeric',
            'total_time' => 'required',
            'value' => 'required',
            'start_time' => 'required|date_format:'.config('app.date_format').' H:i:s',
            'end_time' => 'nullable|date_format:'.config('app.date_format').' H:i:s',
			'assigned_to.*' => 'exists:users,id',
            'qt_employees' => 'max:2147483647|nullable|numeric',
        ];
    }
}
