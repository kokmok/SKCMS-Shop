<?php

namespace SKCMS\ShopBundle\Listener;

use SKCMS\ShopBundle\Entity\Category;
use Doctrine\ORM\Event\LifecycleEventArgs;
/**
 * Description of EntityReferenceLoader
 *
 * @author jona
 */
class CategoryLoader 
{
    private $configEntities;
    
    public function __construct(array $configEntities) 
    {
        $this->configEntities = $configEntities;
    }
    
    
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

       
        if ($entity instanceof Category) 
        {
            foreach ($this->configEntities as $configEntity)
            {
                if (is_subclass_of($configEntity['class'], '\SKCMS\ShopBundle\Entity\SKBaseProduct') && null === $entity->getProducts())
                {
                    $repo = $entityManager->getRepository($configEntity['class']);
                    $products = $repo->findBy(['category'=>$entity]);
                    
                    foreach ($products as $product)
                    {
                        $entity->addProduct($product);
                    }
                }
            }
           
        }
    }
}
