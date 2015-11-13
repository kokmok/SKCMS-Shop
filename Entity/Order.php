<?php

namespace SKCMS\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Order
 *
 * @ORM\Table(name="ecommerce_order")
 * @ORM\Entity(repositoryClass="SKCMS\ShopBundle\Entity\OrderRepository")
 */
class Order
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="feeHTVA", type="float")
     */
    private $feeHTVA;

    /**
     * @var float
     *
     * @ORM\Column(name="feeTVAC", type="float")
     */
    private $feeTVAC;
    
    /**
     * @ORM\ManyToOne(targetEntity="SKCMS\ShopBundle\Entity\OrderStatus")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="SKCMS\ShopBundle\Entity\OrderStatusLog", mappedBy="order",cascade={"all"})
     */
    private $statusLogs;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="SKCMS\UserBundle\Entity\User")
     */
    private $user;

    /**
     *
     * @ORM\ManyToOne(targetEntity="SKCMS\ShopBundle\Entity\Delivery")
     */
    private $delivery;
    
    /**
     *
     * @ORM\OneToOne(targetEntity="SKCMS\ShopBundle\Entity\Cart",inversedBy="order")
     */
    private $cart;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="SKCMS\UserBundle\Entity\Address",cascade={"persist"})
     * @ORM\JoinColumn(name="billing_address_id", referencedColumnName="id")
     */
    private $billingAddress;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="SKCMS\UserBundle\Entity\Address",cascade={"persist"})
     * @ORM\JoinColumn(name="delivery_address_id", referencedColumnName="id")
     */
    private $deliveryAddress;
    
    /**
     *
     * @var Boolean
     * @ORM\Column(name="conditionsAccepted",type="boolean")
     */
    private $conditionsAccepted;
    
    
    
    public function __construct() {
        $this->date = new \DateTime();
        $this->statusLogs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->feeHTVA = 0;
        $this->feeTVAC = 0;
        $this->conditionsAccepted = false;
    }
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function resetId(){
        $this->id = null;
        return $this;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Order
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set feeHTVA
     *
     * @param float $feeHTVA
     * @return Order
     */
    public function setFeeHTVA($feeHTVA)
    {
        $this->feeHTVA = $feeHTVA;

        return $this;
    }

    /**
     * Get feeHTVA
     *
     * @return float 
     */
    public function getFeeHTVA()
    {
        return $this->feeHTVA;
    }

    /**
     * Set feeTVAC
     *
     * @param float $feeTVAC
     * @return Order
     */
    public function setFeeTVAC($feeTVAC)
    {
        $this->feeTVAC = $feeTVAC;

        return $this;
    }

    /**
     * Get feeTVAC
     *
     * @return float 
     */
    public function getFeeTVAC()
    {
        return $this->feeTVAC;
    }

    /**
     * Set status
     *
     * @param \SKCMS\ShopBundle\OrderStatus $status
     * @return Order
     */
    public function setStatus(\SKCMS\ShopBundle\Entity\OrderStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \SKCMS\ShopBundle\OrderStatus 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Add statusLogs
     *
     * @param \SKCMS\ShopBundle\Entity\OrderStatusLog $statusLogs
     * @return Order
     */
    public function addStatusLog(\SKCMS\ShopBundle\Entity\OrderStatusLog $statusLogs)
    {
        $this->statusLogs[] = $statusLogs;

        return $this;
    }

    /**
     * Remove statusLogs
     *
     * @param \SKCMS\ShopBundle\Entity\OrderStatusLog $statusLogs
     */
    public function removeStatusLog(\SKCMS\ShopBundle\Entity\OrderStatusLog $statusLogs)
    {
        $this->statusLogs->removeElement($statusLogs);
    }

    /**
     * Get statusLogs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStatusLogs()
    {
        return $this->statusLogs;
    }

    /**
     * Set user
     *
     * @param \SKCMS\UserBundle\Entity\User $user
     * @return Order
     */
    public function setUser(\SKCMS\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \SKCMS\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set delivery
     *
     * @param \SKCMS\ShopBundle\Entity\Delivery $delivery
     * @return Order
     */
    public function setDelivery(\SKCMS\ShopBundle\Entity\Delivery $delivery = null)
    {
        $this->delivery = $delivery;

        return $this;
    }

    /**
     * Get delivery
     *
     * @return \SKCMS\ShopBundle\Entity\Delivery 
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * Set cart
     *
     * @param \SKCMS\ShopBundle\Entity\Cart $cart
     * @return Order
     */
    public function setCart(\SKCMS\ShopBundle\Entity\Cart $cart = null)
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * Get cart
     *
     * @return \SKCMS\ShopBundle\Entity\Cart 
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * Set billingAddress
     *
     * @param \SKCMS\UserBundle\Entity\Address $billingAddress
     * @return Order
     */
    public function setBillingAddress(\SKCMS\UserBundle\Entity\Address $billingAddress = null)
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    /**
     * Get billingAddress
     *
     * @return \SKCMS\UserBundle\Entity\Address 
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * Set deliveryAddress
     *
     * @param \SKCMS\UserBundle\Entity\Address $deliveryAddress
     * @return Order
     */
    public function setDeliveryAddress(\SKCMS\UserBundle\Entity\Address $deliveryAddress = null)
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    /**
     * Get deliveryAddress
     *
     * @return \SKCMS\UserBundle\Entity\Address 
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }
    
    public function isConditionsAccepted()
    {
        return $this->conditionsAccepted;
    }
    
    public function setConditionsAccepted($conditionsAccepted)
    {
        $this->conditionsAccepted= $conditionsAccepted;
        return $this;
    }
    
    public function processTotalHTVA()
    {
        $total = $this->getTotal();
        $this->feeHTVA = $total;
    }
    
    public function processTotalTVAC()
    {
        $total = $this->getTotalTVAC();
        $this->feeTVAC = $total;
    }
    
    public function getTotalTVAC()
    {
        $total = $this->cart->getTotalTVACInt();
        $total += $this->getDeliveryFee();
        
        $this->feeTVAC = $total;
        
        return $total;
    }
    public function getTotal()
    {
        $total = $this->cart->getTotalInt();
        $total += $this->getDeliveryFee();
        
        $this->feeHTVA = $total;
        
        return $total;
    }
    
    public function getDeliveryFee(Delivery $delivery = null)
    {
        $weight = $this->cart->getWeight();
        
        
        $delivery = $delivery === null ? $this->delivery : $delivery;
        if ($delivery === null)
        {
            return null;
        }
        
        $rule = null;
        foreach ($delivery->getRules() as $deliveryRule)
        {
            if ($deliveryRule->getMaxWeight() >= $weight && ($rule ===null || $rule->getMaxWeight()>$deliveryRule->getMaxWeight() ))
            {
                $rule = $deliveryRule;
            }
        }
        
        if ($rule === null)
        {
            return null;
        }
        
        return $rule->getFee();
        
        
    }
    
    public function __clone()
    {
        if($this->id != null)
        {
            $this->resetId();
            $this->setStatus(null);
            $this->statusLog = new \Doctrine\Common\Collections\ArrayCollection();
            $this->setDate(new \DateTime);
        }
        
        
//        $this->setCart(clone $this->cart);
    }
}
