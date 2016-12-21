<?php


namespace spec\Challenge\Validator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CreditCardValidatorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('\Challenge\Validator\CreditCardValidator');
    }

    public function it_returns_true_for_valid_credit_cards()
    {
        $this->validate('4111111111111111')->shouldBe(true);
    }

    public function it_returns_false_for_invalid_credit_cards()
    {
        $this->validate('1234567890')->shouldBe(false);
    }
}
