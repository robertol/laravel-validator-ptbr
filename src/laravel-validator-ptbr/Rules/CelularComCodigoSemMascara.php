<?php

namespace ValidatorPTBr\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * @author Wallace Maxters <wallacemaxters@gmail.com>
*/
class CelularComCodigoSemMascara implements Rule
{

    
    /**
     * Valida o formato do celular com código do país
     * 
     * @param string $attribute
     * @param string $value
     * @return boolean
    */
    public function passes($attribute, $value)
    {
        return preg_match('/^[+][1-9]{2}\s?\d{2}\s?\d{4,5}\d{4}$/', $value) > 0;
    }

    public function message()
    {
    	return 'O campo :attribute não é um celular válido. Exemplo de celular válido +5514999999999';
    }
}