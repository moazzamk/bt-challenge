<?php

namespace Challenge\Action\Customer;

use Challenge\Entity\Customer;
use Challenge\Exception\ResourceNotFoundException;
use Challenge\Validator\CreditCardValidator;
use Doctrine\ORM\EntityManager;

class UpdateAction
{
    /** @var  CreditCardValidator */
    private $creditCardValidator;

    /** @var EntityManager  */
    private $entityManager;


    /**
     * @param EntityManager $entityManager
     */
    public function __construct(CreditCardValidator $creditCardValidator, EntityManager $entityManager)
    {
        $this->creditCardValidator = $creditCardValidator;
        $this->entityManager = $entityManager;
    }

    public function __invoke($name, $cardNumber, $limit, $updateTs)
    {
        /** @var Customer $customer */
        $customer = $this->entityManager->getRepository('\Challenge\Entity\Customer')->findOneBy(['name' => $name]);
        if (!$customer) {
            throw new ResourceNotFoundException('Customer with that name does not exist');
        }

        $customer->setCardNumber($cardNumber)
                ->setLastUpdateTs($updateTs)
                ->setCardLimit($limit);

        $this->entityManager->flush();
    }
}
