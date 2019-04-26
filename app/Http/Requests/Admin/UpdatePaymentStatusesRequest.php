<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentStatusesRequest extends FormRequest
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
            
            'title' => 'required|unique:payment_statuses,title,'.$this->route('payment_status'),
        ];
    }
}
