<?php


namespace SKCMS\ShopBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use SKCMS\ShopBundle\Entity\OrderStatus;

/**
 * Description of OrderListener
 *
 * @author jona
 */
class OrderStatusListener {
    
    public function PrePersist(LifecycleEventArgs $args)
    {
        $this->checkDefault($args);
        
    }
    
    public function PreUpdate(LifecycleEventArgs $args)
    {
        
        $this->checkDefault($args);
        
    }
    
    public function checkDefault(LifecycleEventArgs $args)
    {
        
        $entity = $args->getEntity();
        $em = $args->getEntityManager();
        
        if ($entity instanceof OrderStatus) 
        {
            if ($entity->isDefault())
            {
                $repo = $em->getRepository('SKCMSShopBundle:OrderStatus');
                $previousDefault = $repo->findOneBy(['default'=>true]);
                
                if (null !== $previousDefault && $previousDefault->getId() != $entity->getId())
                {
                    
                    $args->getEntityManager()->getUnitOfWork()->scheduleExtraUpdate($previousDefault, array(
                        'default' => array(true, false)
                    ));
//                    $previousDefault->setDefault(false);
//                    $em->persist($previousDefault);
//                    $em->flush();
                }
                
            }
            
            
            
            
        }
    }
}
