<?php

namespace spec\Challenge\Action\Customer;

use Challenge\Repository\CustomerRepository;
use PhpSpec\ObjectBehavior;

class SummaryActionSpec extends ObjectBehavior
{
    public function let(CustomerRepository $customerRepository)
    {
        $this->beConstructedWith($customerRepository);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('\Challenge\Action\Customer\SummaryAction');
    }

    public function it_gets_the_summary_for_transactions(CustomerRepository $customerRepository)
    {
        $this->__invoke();
    }
}
