<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientsRequest extends FormRequest
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
            
            'name' => 'required',
            'email' => 'required|email|unique:clients,email,'.$this->route('client'),
            'external_id' => 'max:2147483647|nullable|numeric',
            'birthdate' => 'nullable|date_format:'.config('app.date_format'),
            'street' => 'required',
            'number' => 'max:2147483647|required|numeric',
            'zip' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required',
        ];
    }
}
