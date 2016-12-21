<?php

namespace spec\Challenge\Action\Customer;

use Challenge\Repository\CustomerRepository;
use Doctrine\ORM\EntityManager;
use Challenge\Entity\Customer;
use PhpSpec\ObjectBehavior;

class CreditActionSpec extends ObjectBehavior
{
    public function let(CustomerRepository $customerRepository, EntityManager $entityManager, Customer $customer)
    {
        $customerRepository->findOneBy(['name' => 'name'])->willReturn($customer);
        $entityManager->getRepository('\Challenge\Entity\Customer')->willReturn($customerRepository);
        $entityManager->flush()->willReturn(null);

        $this->beConstructedWith($entityManager);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('\Challenge\Action\Customer\CreditAction');
    }

    public function it_ignores_charges_against_invalid_cards(Customer $customer)
    {
        $customer->getCardBalance()->willReturn(0);
        $customer->getIsCardValid()->willReturn(false);
        $rs = $this->__invoke('name', '$100')->getCardBalance()->shouldBe(0);
    }

    public function it_subtracts_amount_from_the_card_balance(Customer $customer)
    {
        $customer->getIsCardValid()->willReturn(true);
        $customer->getCardBalance()->willReturn(1);
        $customer->getCardLimit()->willReturn(200);
        $customer->setCardBalance(-99)->shouldBecalled();

        $this->__invoke('name', '$100');
    }
}
