<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NSSValidRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(!empty($value) && (strlen($value) % 2) != 0){
        $matches = null;
        $value = preg_replace('/\s+/', '', $value);
        if (!preg_match("/^([0-9]{2}[0-9]{4}[0-9]{4})([0-9]{2})$/i", $value, $matches))
          return false;
        $code = preg_replace(array('/2A/i', '/2B/i'), array(19, 18), $matches[1]);
        $cle  = $matches[2];
        $length = strlen($code);
        $som= 0 ;
        for ($i=0 ; $i < $length ; $i++)
        {
             if($i % 2 == 0)
                  $som += $code[$i] * 2;
             else
                  $som += $code[$i]*1;
        }
        if (99 - $som != $cle)
          return false;       
        return true;
      }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
      return 'le numéro du securite sociale n\'est pas invalide';
    }
}
