<?php

namespace Challenge\Action\Customer;

use Challenge\Repository\CustomerRepository;

class SummaryAction
{
    /** @var  CustomerRepository */
    private $customerRepository;


    /**
     * @param $customerRepository
     */
    public function __construct($customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function __invoke($updateTs)
    {
        $ret = [];
        $customers = $this->customerRepository->findBy(['lastUpdateTs' => $updateTs], ['name' => 'ASC']);
        foreach ($customers as $customer) {
            if ($customer->getIsCardValid()) {
                $ret[$customer->getName()] = '$' . $customer->getCardBalance();
            }
            else {
                $ret[$customer->getName()] = 'error';
            }
        }

        return $ret;
    }
}
