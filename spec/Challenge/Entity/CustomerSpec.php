<?php


namespace spec\Challenge\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CustomerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('\Challenge\Entity\Customer');
    }

    public function it_gets_name()
    {
        $this->getName()->shouldBe(null);
    }

    public function it_gets_balance()
    {
        $this->getCardBalance()->shouldBe(null);
    }

    public function it_gets_limit()
    {
        $this->getCardLimit()->shouldBe(null);
    }

    public function it_gets_card_number()
    {
        $this->getCardNumber()->shouldBe(null);
    }

    public function it_sets_name()
    {
        $this->setName('hi');
        $this->getName('hi')->shouldBe('hi');
    }

    public function it_sets_balance()
    {
        $this->setCardBalance(10);
        $this->getCardBalance()->shouldBe(10);
    }

    public function it_sets_limit()
    {
        $this->setCardLimit(10);
        $this->getCardLimit()->shouldBe(10);
    }

    public function it_sets_card_number()
    {
        $this->setCardNumber('hi');
        $this->getCardNumber()->shouldBe('hi');
    }

    public function it_gets_card_validity()
    {
        $this->getIsCardValid()->shouldBe(null);
    }
    
    public function it_sets_card_validity()
    {
        $this->setIsCardValid(1);
        $this->getIsCardValid()->shouldBe(1);
    }
}
