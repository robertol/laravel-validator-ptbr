<?php

namespace ValidatorPTBr\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * @author Roberto Oliveira <smuxb@gmail.com>
*/
class CelularComDddSemMascara implements Rule
{    
    /**
     * Valida o formato do celular junto com o ddd
     *
     * @param string $attribute
     * @param string $value
     * @return boolean
    */
    public function passes($attribute, $value)
    {
        return preg_match('/^[1-9]{2}\s?\d{4,5}\d{4}$/', $value) > 0;
    }

    public function message()
    {
      return 'O campo :attribute não é um celular com DDD válido.';
    }
}