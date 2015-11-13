<?php

namespace SKCMS\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatusLog
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class OrderStatusLog
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
     *
     * @ORM\ManyToOne(targetEntity="SKCMS\ShopBundle\Entity\OrderStatus")
     */
    private $status;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="SKCMS\ShopBundle\Entity\Order", inversedBy="statusLogs")
     */
    private $order;

    
    public function __construct() 
    {
        $this->date = new \DateTime();
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

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return StatusLog
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
     * Set status
     *
     * @param \SKCMS\ShopBundle\Entity\OrderStatus $status
     * @return CartStatusLog
     */
    public function setStatus(\SKCMS\ShopBundle\Entity\OrderStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \SKCMS\ShopBundle\Entity\OrderStatus 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set order
     *
     * @param \SKCMS\ShopBundle\Entity\Order $order
     * @return CartStatusLog
     */
    public function setOrder(\SKCMS\ShopBundle\Entity\Order $order = null)
    {
        $this->order = $order;
        
        return $this;
    }

    /**
     * Get order
     *
     * @return \SKCMS\ShopBundle\Entity\Order 
     */
    public function getOrder()
    {
        return $this->order;
    }
}
