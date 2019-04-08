<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
            'PicturesUploaded'   => ['required'], //validar imagenes
            'PicturesUploaded.*' => ['mimes:jpeg,png,jpg'], //validar imagenes
            'OriginalPrice'    => ['required'],
            'ActualPrice'      => ['required'],
            'ColorID'          => ['required'],
            'SizeID'           => ['required'],
            'ClothingTypeID'   => ['required'],
            'DepartmentID'     => ['required'],
            'CategoryID'       => ['required'],
            'TypeID'           => ['required'],
            'ClosetID'         => ['required'],
            'OffSaleID'        => ['required']
        ];
    }


    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        $images = [];

        if(count($this->PicturesUploaded) > 0) {

            foreach ($this->PicturesUploaded as $key => $value) {

                $name = $value->getClientOriginalName();

                $images['PicturesUploaded.'.$key .'.mimes'] = $name.' debe ser un archivo con formato: jpeg, png, jpg';
            }
        }

        return $images + [
            'OriginalPrice.required'  => 'El campo :attribute es obligatorio.',
            'ActualPrice.required'    => 'El campo :attribute es obligatorio.',
            'ColorID.required'        => 'El campo :attribute es obligatorio.',
            'SizeID.required'         => 'El campo :attribute es obligatorio.',
            'ClothingTypeID.required' => 'El campo :attribute es obligatorio.',
            'DepartmentID.required'   => 'El campo :attribute es obligatorio.',
            'CategoryID.required'     => 'El campo :attribute es obligatorio.',
            'TypeID.required'         => 'El campo :attribute es obligatorio.',
            'ClosetID.required'       => 'El campo :attribute es obligatorio.',
            'OffSaleID.required'      => 'El campo :attribute es obligatorio.',
        ];
    }
}
