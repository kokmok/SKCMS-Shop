<?php
namespace SKCMS\ShopBundle\Events;

use Symfony\Component\EventDispatcher\Event;

/**
 * Description of OrderStatusChanged
 *
 * @author jona
 */
class OrderStatusChanged extends Event
{
    protected $order;
    protected $newStatus;
    
    public function __construct(\SKCMS\ShopBundle\Entity\Order $order,  \SKCMS\ShopBundle\Entity\OrderStatus $newStatus) 
    {
        $this->order = $order;
        $this->newStatus = $newStatus;
    }
    
    public function getOrder()
    {
        return $this->order;
    }
    public function getNewStatus()
    {
        return $this->newStatus;
    }
    
}
