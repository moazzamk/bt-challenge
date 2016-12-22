<?php

namespace spec\Challenge\Action\Customer;

use Challenge\Entity\Customer;
use Challenge\Repository\CustomerRepository;
use Challenge\Validator\CreditCardValidator;
use Doctrine\ORM\EntityManager;
use Prophecy\Argument;

class AddActionSpec extends \PhpSpec\ObjectBehavior
{
    public function let(
        CreditCardValidator $creditCardValidator,
        CustomerRepository $customerRepository,
        EntityManager $entityManager
    ) {

        $entityManager->getRepository('\Challenge\Entity\Customer')->willReturn($customerRepository);
        $entityManager->persist(Argument::type('\Challenge\Entity\Customer'))->willReturn(null);
        $entityManager->flush()->willReturn(null);

        $creditCardValidator->validate('1')->willReturn(true);
        $creditCardValidator->validate('2')->willReturn(false);

        $this->beConstructedWith($creditCardValidator, $entityManager);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('\Challenge\Action\Customer\AddAction');
    }

    public function it_throws_an_exception_if_customer_already_exists(CustomerRepository $customerRepository, Customer $customer)
    {
        $customerRepository->findOneBy(['name' => 'hi'])->willReturn($customer);
        $this->shouldThrow('\Challenge\Exception\ConflictException')->during__invoke('hi', '123', '10', 123);
    }

    public function it_sets_new_card_balance_to_zero()
    {
        $rs = $this->__invoke('name', '1', '$1000', 123);
        $rs->getCardBalance()->shouldBe(0);
    }

    public function it_creates_new_card_with_provided_values()
    {
        $rs = $this->__invoke('name', '1', '$1000', 123);
        $rs->getLastUpdateTs()->shouldBe(123);
        $rs->getCardNumber()->shouldBe('1');
        $rs->getCardLimit()->shouldBe(1000);
        $rs->getName()->shouldBe('name');
    }

    public function it_checks_if_card_number_is_valid()
    {
        $this->__invoke('name', '1', '$100', 123)->getIsCardValid()->shouldBe(true);
        $this->__invoke('name', '2', '$100', 123)->getIsCardValid()->shouldBe(false);
    }
}
