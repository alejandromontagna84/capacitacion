<?php

namespace Improntus\Clase5\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

/**
 * Make the option for custom dropdown source model
 *
 * Class Customdropdown
 * @package Moazzam\CustomProductAttribute\Model\Source
 */
class Motor extends AbstractSource
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
                ['label' => 'V6', 'value' => 'v6'],
                ['label' => 'V8', 'value' => 'v8'],
                ['label' => 'V12', 'value' => 'v12'],
            ];
        }
        return $this->_options;
    }
}
