<?php

namespace SKCMS\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DeliveryRule
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SKCMS\ShopBundle\Entity\DeliveryRuleRepository")
 */
class DeliveryRule
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="maxWeight", type="float")
     */
    private $maxWeight;

    /**
     * @var float
     *
     * @ORM\Column(name="fee", type="float")
     */
    private $fee;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="SKCMS\ShopBundle\Entity\Delivery",inversedBy="rules")
     */
    private $delivery;


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
     * @return DeliveryRule
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
     * Set maxWeight
     *
     * @param float $maxWeight
     * @return DeliveryRule
     */
    public function setMaxWeight($maxWeight)
    {
        $this->maxWeight = $maxWeight;

        return $this;
    }

    /**
     * Get maxWeight
     *
     * @return float 
     */
    public function getMaxWeight()
    {
        return $this->maxWeight;
    }

    /**
     * Set fee
     *
     * @param float $fee
     * @return DeliveryRule
     */
    public function setFee($fee)
    {
        $this->fee = $fee;

        return $this;
    }

    /**
     * Get fee
     *
     * @return float 
     */
    public function getFee()
    {
        return $this->fee;
    }
    
    public function setDelivery(Delivery $delivery)
    {
        $this->delivery = $delivery;
        return $this;
    }
    
    public function getDelivery()
    {
        return $this->delivery;
    }
}
