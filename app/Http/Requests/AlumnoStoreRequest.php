<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlumnoStoreRequest extends FormRequest
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
            'dni_al' => 'required',
            'nom_al' => 'required',
            'ape_al' => 'required', 
            'fnac_al' => 'required',
            'lnac_al' => 'required',
            'especialidad_id' => 'required',
            'reparto_id' => 'required',
            'tipogrado_id' => 'required',
            'tiposangre_id' => 'required',
            ];
    }
}
