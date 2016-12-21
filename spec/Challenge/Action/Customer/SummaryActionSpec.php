<?php

namespace spec\Challenge\Action\Customer;

use Challenge\Entity\Customer;
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

    public function it_returns_error_balance_for_invalid_cards(CustomerRepository $customerRepository, Customer $customer)
    {
        $customer->getName()->willReturn('name');
        $customer->getCardBalance()->willReturn(100);
        $customer->getIsCardValid()->willReturn(false);
        $customerRepository->findAll()->willReturn([$customer]);
        $this->__invoke()->shouldHaveKeyWithValue('name', 'error');
    }

    public function it_returns_balance_for_valid_cards(CustomerRepository $customerRepository, Customer $customer)
    {
        $customer->getName()->willReturn('name');
        $customer->getCardBalance()->willReturn(100);
        $customer->getIsCardValid()->willReturn(true);
        $customerRepository->findAll()->willReturn([$customer]);
        $this->__invoke()->shouldHaveKeyWithValue('name', 100);
    }
}
