<?php
namespace SKCMS\ShopBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use SKCMS\ShopBundle\Entity\CartProduct;
use SKCMS\CoreBundle\Entity\EntityReference;
/**
 * Description of cartProductLoader
 *
 * @author jona
 */
class cartProductLoader {
    
    public function PrePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();
        
        if ($entity instanceof CartProduct) 
        {
            $productReference = new EntityReference();
            $productReference->setClassName(get_class($entity));
            $productReference->setForeignKey($entity->getId());
            
            $entity->setProductReference($productReference);
            
        }
    }
    
}
