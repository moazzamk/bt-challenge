<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Customers
 *
 * @ORM\Table(name="customers")
 * @ORM\Entity
 */
class Customers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @return Customers
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
     * @return Customers
     */
    public function setCardBalance($cardBalance)
    {
        $this->cardBalance = $cardBalance;

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
     * @return Customers
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
     * @return Customers
     */
    public function setCardLimit($cardLimit)
    {
        $this->cardLimit = $cardLimit;

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
     * @return Customers
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
}
