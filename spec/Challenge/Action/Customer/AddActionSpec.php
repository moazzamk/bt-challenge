<?php

namespace spec\Challenge\Action\Customer;

use Challenge\Validator\CreditCardValidator;
use Doctrine\ORM\EntityManager;
use Prophecy\Argument;

class AddActionSpec extends \PhpSpec\ObjectBehavior
{
    public function let(CreditCardValidator $creditCardValidator, EntityManager $entityManager)
    {
        $creditCardValidator->validate('1')->willReturn(true);
        $creditCardValidator->validate('2')->willReturn(false);

        $this->beConstructedWith($creditCardValidator, $entityManager);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('\Challenge\Action\Customer\AddAction');
    }

    public function it_sets_new_card_balance_to_zero()
    {
        $rs = $this->__invoke('name', '1', '$1000');
        $rs->getCardBalance()->shouldBe(0);
    }

    public function it_creates_new_card_with_provided_values()
    {
        $rs = $this->__invoke('name', '1', '$1000');
        $rs->getCardNumber()->shouldBe('1');
        $rs->getCardLimit()->shouldBe(1000);
        $rs->getName()->shouldBe('name');
    }

    public function it_checks_if_card_number_is_valid()
    {
        $this->__invoke('name', '1', '$100')->getIsCardValid()->shouldBe(true);
        $this->__invoke('name', '2', '$100')->getIsCardValid()->shouldBe(false);
    }
}
