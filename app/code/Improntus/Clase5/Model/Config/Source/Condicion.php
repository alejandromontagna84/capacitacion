<?php

namespace Improntus\Clase5\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Condicion extends AbstractSource
{
    /**
     * Make the option for source model
     *
     * @return array|array[]|null
     */
    public function getAllOptions(): ?array
    {
        if ($this->_options === null) {
            $this->_options = [
                ['label' => '--Select--', 'value' => ''],
                ['label' => 'Nuevo', 'value' => 'nuevo'],
                ['label' => 'Usado', 'value' => 'usado'],
            ];
        }
        return $this->_options;
    }
}
