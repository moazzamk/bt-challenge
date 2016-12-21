<?php

namespace Challenge\Action\Customer;

use Doctrine\ORM\EntityManager;

class ChargeAction
{
    /** @var  EntityManager */
    private $entityManager;

    private $customerRepository;


    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->customerRepository = $entityManager->getRepository('\Challenge\Entity\Customer');
        $this->entityManager = $entityManager;
    }

    public function __invoke($name, $amount)
    {
        /** @var \Challenge\Entity\Customer $customer */
        $delta = (int)substr($amount, 1);
        $customer = $this->customerRepository->findOneBy(['name' => $name]);

        if (!$customer->getIsCardValid()) {
            return $customer;
        }

        if ($customer->getCardBalance() + $delta > $customer->getCardLimit()) {
            return $customer;
        }

        $customer->setCardBalance($customer->getCardBalance() + $delta);

        $this->entityManager->flush();

        return $customer;
    }
}