<?php
namespace App\Common;

use App\Exceptions\FormException;

trait ValidatorTrait
{

    protected function validate(array $fields, array $rules)
    {
        $validator = \Validator::make($fields, $rules);


        if ($validator->fails()) {

            $errorMessages = [];

            foreach ($validator->errors()->getMessages() as $field => $errors) {
                $errorMessages[$field] = '';
                foreach ($errors as $error) {
                    $errorMessages[$field] .= $error;
                }
            }

            $e = new FormException('Invalid form');
            $e->setFieldErrors($errorMessages);
            throw $e;
        }
    }
}
