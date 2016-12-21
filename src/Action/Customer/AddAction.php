<?php

namespace Challenge\Action\Customer;


use Challenge\Entity\Customer;
use Challenge\Validator\CreditCardValidator;
use Doctrine\ORM\EntityManager;

class AddAction
{
    /** @var  \Challenge\Validator\CreditCardValidator */
    private $creditCardValidator;

    /** @var \Doctrine\ORM\EntityManager */
    private $entityManager;


    /**
     * @param CreditCardValidator  $creditCardValidator
     * @param EntityManager        $entityManager
     */
    public function __construct(CreditCardValidator $creditCardValidator, EntityManager $entityManager)
    {
        $this->creditCardValidator = $creditCardValidator;
        $this->entityManager = $entityManager;
    }

    public function __invoke($name, $cardNumber, $limit)
    {
        $cardLimit = substr($limit, 1);
        $isValidCard = $this->creditCardValidator->validate($cardNumber);
        $customer = new Customer();
        $customer->setCardLimit($cardLimit)
            ->setIsCardValid($isValidCard)
            ->setCardNumber($cardNumber)
            ->setName($name)
            ->setCardBalance(0);

        $this->entityManager->persist($customer);
        $this->entityManager->flush();

        return $customer;
    }
}