<?php
namespace SKCMS\ShopBundle\Service;

use Symfony\Component\Form\FormFactoryInterface;
use Twig_Environment;
use Symfony\Component\DependencyInjection\Container;
use \SKCMS\ShopBundle\Form\CartProductType;
use \Symfony\Component\HttpFoundation\Request;
use \SKCMS\ShopBundle\Entity\SKBaseProduct;
use \SKCMS\ShopBundle\Entity\CartProduct;
use \SKCMS\CoreBundle\Entity\EntityReference;
use Symfony\Component\HttpFoundation\RequestStack;

use SKCMS\ShopBundle\Entity\Cart;

/**
 * Description of ProductUtils
 *
 * @author jona
 */
class CartUtils 
{
    private $formFactory;
    private $twig;
    
    
    private $form;
    private $session;
    private $router;
    
    private $container;
    private $request;
    private $em;
    private $user;
    
    private $cart;
    
    public function __construct(Container $container) 
    {
        $this->container = $container;
        $this->request = $container->get('request');
        $this->em = $container->get('doctrine')->getManager();
        $this->user = $container->get('security.context')->getToken()->getUser();
        
        
    }
    
    /**
     * 
     * @param type $createIfNotExists
     * @return SKCMS\ShopBundle\Entity\Cart
     */
    public function getCurrentCart($createIfNotExists = true)
    {
        if ($this->cart !== null)
        {
            return $this->cart;
        }
        
        $cartId = $this->request->cookies->get('cartId');
        if (null === $cartId && !$createIfNotExists)
        {
            return null;
        }
        else if(null === $cartId && $createIfNotExists)
        {
            $this->cart = $this->createCart();
            
        }
        else
        {
            $repo = $this->em->getRepository('SKCMSShopBundle:Cart');
            $this->cart = $repo->find($cartId);
        }
        
        
        
        return $this->cart;
    }
    
    public function createCart()
    {
        $cart = new Cart();
        
        $this->em->persist($cart);
        $this->em->flush();
        return $cart;
    }
    
    public function removeProductById($cartProductId)
    {
        $this->getCurrentCart();
        $cartProducts = $this->cart->getProducts()->toArray();
        foreach ($cartProducts as $cartProduct)
        {
            if ($cartProduct->getId() == $cartProductId)
            {
                if ($this->cart->getProducts()->contains($cartProduct))
                {
                    dump('remove');
                }
                $this->cart->removeProduct($cartProduct);
                $this->em->remove($cartProduct);
                $this->em->persist($this->cart);
                
                $this->em->flush();
                
            }
        }
    }
}
