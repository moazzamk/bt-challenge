<?php

namespace spec\Challenge\Action\Customer;

use Challenge\Entity\Customer;
use Challenge\Repository\CustomerRepository;
use Challenge\Validator\CreditCardValidator;
use Doctrine\ORM\EntityManager;
use PhpSpec\ObjectBehavior;

class UpdateActionSpec extends ObjectBehavior
{
    public function let(
        CreditCardValidator $creditCardValidator,
        CustomerRepository $customerRepository,
        EntityManager $entityManager
    ) {
        $entityManager->getRepository('\Challenge\Entity\Customer')->willReturn($customerRepository);
        $entityManager->flush()->willReturn(null);

        $this->beConstructedWith($creditCardValidator, $entityManager);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('\Challenge\Action\Customer\UpdateAction');
    }

    public function it_throws_an_exception_if_customer_does_not_exist(CustomerRepository $customerRepository)
    {
        $customerRepository->findOneBy(['name' => 'hi'])->willReturn(null);
        $this->shouldThrow('\Challenge\Exception\ResourceNotFoundException')->during__invoke('hi', '123', '10', 10);
    }

    public function it_updates_existing_customer(CustomerRepository $customerRepository, Customer $customer)
    {
        $customer->setCardNumber('123')->willReturn($customer);
        $customer->setLastUpdateTs(10)->willReturn($customer);
        $customer->setCardLimit(10)->willReturn($customer);

        $customer->setCardNumber('123')->shouldBeCalled();
        $customer->setLastUpdateTs(10)->shouldBeCalled();
        $customer->setCardLimit(10)->shouldBeCalled();

        $customerRepository->findOneBy(['name' => 'hi'])->willReturn($customer);
        $this->__invoke('hi', '123', '10', 10);
    }
}