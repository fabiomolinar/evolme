<?php

namespace Evolme\Http\Requests;

use Evolme\Http\Requests\Request;

class BuscarRequest extends Request
{
  /* Essa request serve para os estabelecimentos que o próprio dono está querendo adicionar a sua conta!!! */

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
            'cidade' => 'required',
            'estabelecimento' => 'required'
        ];
    }

    public function messages()
    {
        return [
          'cidade' => 'O campo "cidade" é obrigatório.',
          'estabelecimento' => 'O campo "estabelecimento" é obrigatório.'
        ];
    }
}
