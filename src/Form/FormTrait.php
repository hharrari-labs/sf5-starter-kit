<?php

namespace App\Form;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait FormTrait
{
    /**
     * Format options for inputs
     *
     * @param string $label 
     * @param array $options
     * @param bool $date
     * @return array
     */
    public function setOptions(string $label, array $options = null, bool $date = false): array
    {
        if ($date === false) {  
            $optionsToMerge = ($label != false) ? ['label_format' => $label] : ['label_format' => false];
        } else {
            $optionsToMerge = ($label != false) ? ['label_format' => $label, 'widget' => 'single_text', 'html5' => true, 'attr' => ['class' => 'datepicker']] : ['label_format' => false, 'widget' => 'single_text', 'html5' => true, 'attr' => ['class' => 'datepicker']];
        }

        return ($options != null) ? array_merge_recursive($options, $optionsToMerge) : $optionsToMerge;
    }
}
