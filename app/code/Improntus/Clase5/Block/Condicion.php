<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Improntus\Clase5\Block;

class Condicion extends \Magento\Catalog\Block\Product\View
{


    /**
     * @return bool
     */
    public function displayCondicion()
    {
        $product = $this->getProduct();
        return $product->getAttributeText('condicion') == 'Nuevo';
    }
}
