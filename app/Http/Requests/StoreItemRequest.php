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
        $ActualPrice   = floatval(ltrim($this->ActualPrice, '$'));

        $discountPrice = 0;
        $discount      = 99;
        $validation    = $ActualPrice < 180 ? 'min:180': '';
        $numeric       = '';

        if($this->Discount) {

            $numeric        = 'numeric';
             $discountPrice = $ActualPrice - ($ActualPrice * $this->Discount) / 100;
             $isValid       = $discountPrice < 180 ? false : true;

             if(!$isValid) {
                for ($i=1; $i < $this->Discount; $i++) { 

                    $value = $this->Discount - $i;
                    
                    $discountPrice = $ActualPrice - ($ActualPrice * $value) / 100;
                    $isValid       = $discountPrice < 180 ? false : true;

                    if($isValid) {
                        $discount = $value;
                        break;
                    }
                }
            }
        }

        return [
            'ActualPrice' => [$validation],
            'Discount'   => [$numeric,'max:'.$discount]
            //'PicturesUploaded'   => ['required'], //validar imagenes
            //'cover_item_file' => ['mimes:jpeg,png,jpg'], //validar imagenes
            //'front_item_file' => ['mimes:jpeg,png,jpg'], 
            //'label_item_file' => ['mimes:jpeg,png,jpg'], 
            //'back_item_file' => ['mimes:jpeg,png,jpg'], 
            /*'OriginalPrice'    => ['required'],
            'ActualPrice'      => ['required'],
            'ColorID'          => ['required'],
            'SizeID'           => ['required'],
            'ClothingTypeID'   => ['required'],
            'DepartmentID'     => ['required'],
            'CategoryID'       => ['required'],
            'TypeID'           => ['required'],
            'ClosetID'         => ['required'],
            'OffSaleID'        => ['required']*/
        ];
    }


    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        // $images = [];

        // if(isset($this->PicturesUploaded) && count($this->PicturesUploaded) > 0) {

        //     foreach ($this->PicturesUploaded as $key => $value) {

        //         $name = $value->getClientOriginalName();

        //         $images['PicturesUploaded.'.$key .'.mimes'] = $name.' debe ser un archivo con formato: jpeg, png, jpg';
        //     }
        // }

        return [
            'ActualPrice.numeric' => 'El precio debe ser numérico',
            'ActualPrice.min'     => 'El precio mínimo de la prenda debe ser $180',
            'Discount.numeric'    => 'El descuento debe ser numérico',
            'Discount.max'        => 'El descuento máx. que puedes agregar a tu prenda es :max%',
        ];
    }
}
