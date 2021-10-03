<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PersonOrOffice implements Rule
{

    protected $person;
    protected $office;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($person, $office)
    {
        //
        $this->person = $person;
        $this->office = $office;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $person
     * @param  mixed  $office
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        if(empty($this->person)){
            return !empty($this->office);
        }else if(empty($this->office)){
            return !empty($this->person);
        }
        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Enter person or office';
    }
}
