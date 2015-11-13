<?php


namespace SKCMS\ShopBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use SKCMS\ShopBundle\Entity\Order;
use SKCMS\ShopBundle\Entity\OrderStatusLog;
/**
 * Description of OrderListener
 *
 * @author jona
 */
class OrderListener {
    
    private $em;
    private $order;
    private $eventDispatcher;
    
    public function __construct(\Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }
    
    public function PrePersist(LifecycleEventArgs $args)
    {

        $entity = $args->getEntity();
        $this->em = $args->getEntityManager();
        if ($entity instanceof Order) 
        {
            $this->order = $entity;
            $this->setDefaultStatus();
            $log = $this->createLog($this->order);
            $this->order->addStatusLog($log);
            
//            $classMetadata = $this->em->getClassMetadata(get_class($this->order));
//            $this->em->getUnitOfWork()->computeChangeSet($classMetadata, $this->order);
            
//            $this->saveLog($log);

            
        }
        
    }
    
    
    public function PreUpdate(PreUpdateEventArgs $args)
    {
        
        $entity = $args->getEntity();
        $this->em = $args->getEntityManager();
        
        
        if ($entity instanceof Order) 
        {
            $this->order = $entity;
            if ($args->hasChangedField('status')) 
            {
                $log = $this->createLog();
                $this->order->addStatusLog($log);

                $this->em->getUnitOfWork()->scheduleExtraUpdate($entity, ['statusLogs'=>$this->order->getStatusLogs()]);
//                $this->em->getUnitOfWork()->computeChangeSets();
//                $this->em->getUnitOfWork()->commit();
            }
            
            
        }
        
        
    }
    
    private function setDefaultStatus()
    {
        if ($this->order->getStatus() === null)
        {
            $repo = $this->em->getRepository('SKCMSShopBundle:OrderStatus');
            $defaultStatus = $repo->findOneBy(['default'=>true]);
            $this->order->setStatus($defaultStatus);
        }
        
    }
    
    private function createLog()
    {
        $orderStatusLog = new OrderStatusLog();
        $orderStatusLog->setStatus($this->order->getStatus());
        $orderStatusLog->setOrder($this->order);
        
        $event = new \SKCMS\ShopBundle\Events\OrderStatusChanged($this->order, $this->order->getStatus());
        $this->eventDispatcher->dispatch(\SKCMS\ShopBundle\Events\SKCMSShopEvents::ORDER_STATUS_CHANGED, $event);

      
        
        return $orderStatusLog;
        
    }
    
//    private function saveLog($orderStatusLog)
//    {
////        $this->em->getUnitOfWork()->scheduleForInsert($orderStatusLog);
//
//    }
    
    
}
