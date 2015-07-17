<?php

namespace SKCMS\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Price
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SKCMS\ShopBundle\Entity\PriceRepository")
 */
class Price
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="SKCMS\ShopBundle\Entity\Currency")
     */
    protected $currency;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="SKCMS\ShopBundle\Entity\SKBaseProduct",inversedBy="price")
     */
    protected $product;


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
     * Set amount
     *
     * @param float $amount
     * @return Price
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set currency
     *
     * @param \SKCMS\ShopBundle\Entity\Currency $currency
     * @return Price
     */
    public function setCurrency(\SKCMS\ShopBundle\Entity\Currency $currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \SKCMS\ShopBundle\Entity\Currency 
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set product
     *
     * @param \SKCMS\ShopBundle\Entity\SKBaseProduct $product
     * @return Price
     */
    public function setProduct(\SKCMS\ShopBundle\Entity\SKBaseProduct $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \SKCMS\ShopBundle\Entity\SKBaseProduct 
     */
    public function getProduct()
    {
        return $this->product;
    }
}
