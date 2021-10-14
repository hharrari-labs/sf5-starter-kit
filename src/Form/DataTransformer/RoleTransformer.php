<?php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use UnexpectedValueException;

class RoleTransformer implements DataTransformerInterface
{
    /**
     * @inheritDoc
     */
    public function transform($array)
    {
        if (empty($array)) throw new UnexpectedValueException('The $array parameter can\'t be empty');
        
        return $array[0];
    }

    /**
     * @inheritDoc
     */
    public function reverseTransform($string)
    {
        return [$string];
    }
}
