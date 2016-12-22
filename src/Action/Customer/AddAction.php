<?php

namespace Challenge\Action\Customer;


use Challenge\Entity\Customer;
use Challenge\Exception\ConflictException;
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

    public function __invoke($name, $cardNumber, $limit, $updateTs)
    {
        $customer = $this->entityManager->getRepository('\Challenge\Entity\Customer')->findOneBy(['name' => $name]);
        if ($customer instanceof Customer) {
            throw new ConflictException('Customer exists already');
        }

        $cardLimit = substr($limit, 1);
        $isValidCard = $this->creditCardValidator->validate($cardNumber);
        $customer = new Customer();
        $customer->setCardLimit($cardLimit)
                ->setIsCardValid($isValidCard)
                ->setCardNumber($cardNumber)
                ->setLastUpdateTs($updateTs)
                ->setCardBalance(0)
                ->setName($name);

        $this->entityManager->persist($customer);
        $this->entityManager->flush();

        return $customer;
    }
}