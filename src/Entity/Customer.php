<?php

namespace Challenge\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Customers
 *
 * @ORM\Table(name="customers")
 * @ORM\Entity(repositoryClass="\Challenge\Repository\CustomerRepository")
 */
class Customer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="string", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="card_balance", type="integer", nullable=true)
     */
    private $cardBalance;

    /**
     * @var string
     *
     * @ORM\Column(name="card_number", type="string", length=18, nullable=true)
     */
    private $cardNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="card_limit", type="integer", nullable=true)
     */
    private $cardLimit;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_card_valid", type="integer", nullable=true)
     */
    private $isCardValid;


    /**
     * @var integer
     *
     * @ORM\Column(name="last_update_ts", type="integer", nullable=false)
     */
    private $lastUpdateTs = 0;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Customer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set cardBalance
     *
     * @param integer $cardBalance
     *
     * @return Customer
     */
    public function setCardBalance($cardBalance)
    {
        $this->cardBalance = (int)$cardBalance;

        return $this;
    }

    /**
     * Get cardBalance
     *
     * @return integer
     */
    public function getCardBalance()
    {
        return $this->cardBalance;
    }

    /**
     * Set cardNumber
     *
     * @param string $cardNumber
     *
     * @return Customer
     */
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    /**
     * Get cardNumber
     *
     * @return string
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * Set cardLimit
     *
     * @param integer $cardLimit
     *
     * @return Customer
     */
    public function setCardLimit($cardLimit)
    {
        $this->cardLimit = (int)$cardLimit;

        return $this;
    }

    /**
     * Get cardLimit
     *
     * @return integer
     */
    public function getCardLimit()
    {
        return $this->cardLimit;
    }

    /**
     * Set isCardValid
     *
     * @param integer $isCardValid
     *
     * @return Customer
     */
    public function setIsCardValid($isCardValid)
    {
        $this->isCardValid = $isCardValid;

        return $this;
    }

    /**
     * Get isCardValid
     *
     * @return integer
     */
    public function getIsCardValid()
    {
        return $this->isCardValid;
    }

    /**
     * @return integer
     */
    public function getLastUpdateTs()
    {
        return $this->lastUpdateTs;
    }

    /**
     * @param int $lastUpdateTs
     *
     * @return Customer
     */
    public function setLastUpdateTs($lastUpdateTs)
    {
        $this->lastUpdateTs = $lastUpdateTs;

        return $this;
    }


}
