<?php

namespace ValidatorPTBr\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * @author Roberto Oliveira <smuxbr@gmail.com>
 */
class CnpjAlpha implements Rule
{



    /**
     * Valida se o CNPJ é válido
     * 
     * @param string $attribute
     * @param string $value
     * @return boolean
    */
    public function passes($attribute, $value)
    {
        $c = preg_replace('/((?![0-9A-Z]).)/', '', strtoupper($value));

        $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        if (strlen($c) != 14) {
            return false;

        }

        // Remove sequências repetidas como "111111111111"
        // https://github.com/LaravelLegends/laravel-validator-ptbr/issues/4

        elseif (preg_match("/^{$c[0]}{14}$/", $c) > 0) {

            return false;
        }

        for ($i = 0, $n = 0; $i < 12; $n += (ord($c[$i]) - 48) * $b[++$i]);

        if ($c[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for ($i = 0, $n = 0; $i <= 12; $n += (ord($c[$i]) - 48) * $b[$i++]);

        if ($c[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;

    }


    public function message()
    {
    	return 'O campo :attribute não é um CNPJ válido.';
    }
}