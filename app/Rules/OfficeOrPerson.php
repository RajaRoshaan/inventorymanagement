<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Output\ConsoleOutput;

class OfficeOrPerson implements Rule
{
    
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $office;
    protected $person;

    public function __construct($office, $person)
    {
        //
        $this->office = $office;
        $this->person = $person;
        
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
        //
        if(empty($this->office)){
            return !empty($this->person);
        }else if(empty($this->person)){
            return !empty($this->office);
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Enter office or person';
    }
}
