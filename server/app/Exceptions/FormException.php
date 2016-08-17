<?php
namespace App\Exceptions;

class FormException extends \Exception
{
    protected $fieldErrors;

    /**
     * @return mixed
     */
    public function getFieldErrors()
    {
        return $this->fieldErrors;
    }

    /**
     * @param mixed $filedErrors
     */
    public function setFieldErrors(array $filedErrors)
    {
        $this->fieldErrors = $filedErrors;
    }


}
