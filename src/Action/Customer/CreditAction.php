<?php

namespace Challenge\Action\Customer;

use Doctrine\ORM\EntityManager;

class CreditAction
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

    public function __invoke($name, $amount, $updateTs)
    {
        /** @var \Challenge\Entity\Customer $customer */
        $delta = (int)substr($amount, 1);
        $customer = $this->customerRepository->findOneBy(['name' => $name]);

        if (!$customer->getIsCardValid()) {
            return $customer;
        }

        $customer->setCardBalance($customer->getCardBalance() - $delta)
                ->setLastUpdateTs($updateTs);

        $this->entityManager->flush();
    }

}
