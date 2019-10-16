<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;

class ApplicationType extends AbstractType {
    /**
     * Permet d'avoir la configuration de base d'un champs
     *
     * @param string $label
     * @param array $options
     * @return array
     */
    protected function getConfiguration($label)
    {
        return array_merge([
            'label' => $label
        ]);
    }
}