<?php

namespace ValidatorPTBr\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * @author Wallace Maxters <wallacemaxters@gmail.com>
 */
class TelefoneComDdd implements Rule
{
    /**
     * Valida o formato do telefone junto com o ddd
     * 
     * @param string $attribute
     * @param string $value
     * @return boolean
    */

    public function passes($attribute, $value)
    {
        return preg_match('/^\(\d{2}\)\s?\d{4}-\d{4}$/', $value) > 0;
    }


    public function message()
    {
    	return 'O campo :attribute não é um telefone com DDD válido.';
    }
}