<?php

namespace Challenge\Action\Customer;

class SummaryAction
{
    private $customerRepository;


    /**
     * @param $customerRepository
     */
    public function __construct($customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function __invoke()
    {
        $ret = [];
        $customers = $this->customerRepository->findAll();
        foreach ($customers as $customer) {
            if ($customer->getIsCardValid()) {
                $ret[$customer->getName()] = $customer->getCardBalance();
            }
            else {
                $ret[$customer->getName()] = 'error';
            }

        }

        return $ret;
    }

}
