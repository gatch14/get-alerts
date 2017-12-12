<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCryptoRequest extends FormRequest
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
        $dataSymbol = app('App\Http\Controllers\ApiDataController')->getSymbol();
        return [
            'name' => 'required|in:' . implode(',', $dataSymbol),
            'price' => 'required|numeric',
            'choices' => 'required|in:low,high',
            'choices_value' => 'required|in:BTC,$'
        ];
    }

    /**
     * @return request name in strtoupper
     */
    public function getValidatorInstance()
    {
        $name = $this->all();
        $name['name'] = strtoupper(request('name'));
        $this->getInputSource()->replace($name);

        return parent::getValidatorInstance();
    }
}
