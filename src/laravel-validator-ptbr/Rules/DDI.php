<?php

namespace ValidatorPTBr\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * @author Roberto Oliveira <smuxbr@gmail.com>
 */
class DDI implements Rule
{

    /**
     * Valida o formato do DDI
     * @param string $attribute
     * @param string $value
     * @return boolean
    */
    public function passes($attribute, $value): bool
    {
        return preg_match('/^\+([1-9]\d{0,2})$/', $value) > 0;
    }

    public function message()
    {
        return 'O campo :attribute não é um DDI válido. Exemplo de DDI válido: +55';
    }
}