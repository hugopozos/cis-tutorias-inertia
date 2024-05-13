<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class InstitutionalEmailRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Extrae el dominio del correo electrónico
        $domain = substr(strrchr($value, "@"), 1);

        // Comprueba si el dominio es 'veracruz.tecnm.mx'
        if ($domain !== 'veracruz.tecnm.mx') {
            $fail('El dominio del correo electrónico debe ser @veracruz.tecnm.mx');
        }
    }
}
