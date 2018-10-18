<?php

namespace GastosDTI\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use GastosDTI\Item;

class ItemStoreRequest extends FormRequest
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
            'name' => 'required|max:25',
            'active' => 'required',
            'categorie_id' => [
                Rule::exists('categories','id'),
                'required',
                'present'
            ],  

            'storage_id' => [
                Rule::exists('storages','id'),
                'required',
                'present'

            ], 

        ];
    }

    public function createItem()
    {

        Item::create([
            'name' => $this->name,
            'active' => $this->active,
            'categorie_id' => $this->categorie_id,
            'storage_id' => $this->storage_id,
        ]);

    }

}
