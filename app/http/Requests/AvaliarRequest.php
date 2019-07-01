<?php

namespace Evolme\Http\Requests;

use Evolme\Http\Requests\Request;

class AvaliarRequest extends Request
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
            'quality_score' => 'required|numeric|min:1|max:5',
            'time_score' => 'required|numeric|min:1|max:5',
            'price_score' => 'required|numeric|min:1|max:5',
            'service_score' => 'required|numeric|min:1|max:5',
            'freq_us' => 'numeric|max:180',
            'freq_general' => 'numeric|max:180',
            'birth_date' => 'date'
        ];
    }

    public function messages()
    {
        return [
          'qualidade' => 'É preciso dar uma nota para a qualidade do estabelecimento.',
          'tempo' => 'É preciso dar uma nota para o tempo de espera no estabelecimento.',
          'preco' => 'É preciso dar uma nota para o preço do estabelecimento.',
          'localizacao' => 'É preciso dar uma nota para a localização do estabelecimento.',
          'freq_us' => 'O campo de frequência em um estabelecimento tem que ser númerico.',
          'freq_general' => 'O campo de frequência no estabelecimento em questão tem que ser númerico.',
          'birth_date' => 'O campo nascimento tem que ser uma data válida.'
        ];
    }
}
