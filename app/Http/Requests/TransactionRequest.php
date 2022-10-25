<?php

namespace App\Http\Requests;

use App\Models\Bank;
use App\Models\Checkout;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'user_id'   =>  'required|exists:users,id',
            'type'      =>  'required',
            'amount'    =>  'required',
            'category'  =>  'required',
            'source'    =>  'required',
        ];
    }

    /**
     * @param $validator
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator)
        {
            if($this->request->get('source') == 0)
                $source = Bank::where('user_id', '=', $this->request->get('user_id'))->first();
            else
                $source = Checkout::where('user_id', '=', $this->request->get('user_id'))->first();

            if($this->request->get('type') == 0)
            {
                if(floatval($this->request->get('amount')) > $source->sold)
                    $validator->errors()->add('amount', trans('validation.amount_to_high'));

                if($source->sold - (floatval($this->request->get('amount'))) < 0)
                    $validator->errors()->add('amount', trans('validation.amount_to_high'));
            }
        });
    }
}
