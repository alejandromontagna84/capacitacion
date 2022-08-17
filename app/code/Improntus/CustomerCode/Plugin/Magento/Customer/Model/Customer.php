<?php

namespace Improntus\CustomerCode\Plugin\Magento\Customer\Model;

class Customer
{

    public function aroundSave(
        \Magento\Customer\Model\Customer $subject,
        \Closure $proceed
    ) {

        $firstname = $subject->getFirstname();
        $intVal = (int)filter_var($firstname, FILTER_SANITIZE_NUMBER_INT);
        if ($intVal == 0){
            $newName = $firstname . '1';
        } else{
            $newName = str_replace((string)$intVal, (string)($intVal + 1), $firstname);
        }
        $subject->setData('firstname', $newName);

        $result = $proceed();
        return $result;
    }
}
