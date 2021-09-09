<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocenteStoreRequest extends FormRequest
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
            'dni_doc' => 'required',
            'nom_doc' => 'required',
            'ape_doc' => 'required',
            'instt_docp' => 'required',
            'cobt_doc' => 'required',
            'lnac_doc' => 'required',
            'fnac_doc' => 'required',
            'especialidad_id' => 'required',
            'reparto_id' => 'required', 
            'tiposangre_id' => 'required',
            'tipogrado_id' => 'required',

        ];
    }
}
