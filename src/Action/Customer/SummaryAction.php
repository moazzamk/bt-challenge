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
            $ret[] = [
                $customer->getName() => $customer->getCardBalance()
            ];
        }

        return $ret;
    }

}