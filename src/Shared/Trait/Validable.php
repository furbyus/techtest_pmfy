<?php

namespace Paymefy\Shared\Trait;

use Symfony\Component\Validator\Validation;
use Paymefy\Shared\Exception\ValidationException;

trait Validable
{
    /* Method that validates the object passed as argument. If not object is passed, it validates self instance
    * 
    * 
    * @throws ValidationException
    */
    public function validate(?Object $object): void
    {
        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping(true)
            ->getValidator();

        $errors = $validator->validate($object ?: $this);
        if (count($errors) > 0) {
            //TODO en lugar de los errors toString, podemos formatear esto de manera más entendible.
            throw new ValidationException((string) $errors);
        }
    }
}
