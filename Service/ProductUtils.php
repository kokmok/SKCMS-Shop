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

/**
 * Description of ProductUtils
 *
 * @author jona
 */
class ProductUtils 
{
    private $formFactory;
    private $twig;
    private $container;
    private $request;
    private $form;
    private $session;
    private $em;
    private $router;
    private $cartUtils;
    private $cart;
    
    
    public function __construct(FormFactoryInterface $formFactory, \Twig_Environment $twig,Container $container,  \SKCMS\ShopBundle\Service\CartUtils $cartUtils) 
    {
        $this->formFactory = $formFactory;
        $this->twig = $twig;
        $this->container = $container;
        $this->request = $this->container->get('request');
        $doctrine = $this->container->get('doctrine');
        $this->em = $doctrine->getManager();
        $this->session = $container->get('session');
        $this->router = $container->get('router');
        $this->cartUtils = $cartUtils;
        $this->cart = $cartUtils->getCurrentCart();
    }
    
    
    
    public function getProductForm(SKBaseProduct $product)
    {
        $form = $this->createProductForm($product);
        $formHTML = $this->twig->render('SKCMSShopBundle:Form:cart-product-form.html.twig',['shopForm'=>$form->createView(),'product'=>$product]);
        return $formHTML;
    }
    
    
    private function createProductForm(SKBaseProduct $product)
    {

        $cartProduct = new CartProduct();
        
        $reference = new EntityReference();
        $reference->setEntity($product);
        $cartProduct->setProductReference($reference);
        
        $existingInCart = $this->findExistingReference($cartProduct);
        
        if ($existingInCart !== null)
        {
            $cartProduct = $existingInCart;
        }
        
        
        
        $form = $this->formFactory->create(new CartProductType(),$cartProduct);
        
        return $form;
    }
    
    
    
    public function addProductFromRequest()
    {
       
        $cartProduct = new CartProduct();
        $form = $this->formFactory->create(new CartProductType(),$cartProduct);

        if ($this->request->getMethod() == 'POST')
        {
            $form->handleRequest($this->request);
            
            if ($form->isValid())
            {
               
                 
                $existingProductInCart = $this->findExistingReference($cartProduct);
                if (null !== $existingProductInCart)
                {
                    $existingProductInCart->setComment($cartProduct->getComment());
                    $existingProductInCart->setQuantity($cartProduct->getQuantity());
                    $cartProduct = $existingProductInCart;
                }
                else
                {
                    $repo = $this->em->getRepository($cartProduct->getProductReference()->getClassName());
                    $entity = $repo->find($cartProduct->getProductReference()->getForeignKey());
                    $cartProduct->getProductReference()->setEntity($entity);
                    $cartProduct->setProduct($entity);
                    

                    $cartProduct->setCart($this->cart);
                }
                
                
                
                
                
                
                $this->em->persist($this->cart);
                $this->em->persist($cartProduct);
                
                $this->em->flush();
                
                return true;
            }
            else
            {
                
                throw new \ErrorException('Form invalid');
            }
        }
    }
    
    public function findExistingReference(CartProduct $newCartProduct)
    {
        
        
        foreach ($this->cart->getProducts() as $cartProduct)
        {
            $className = $cartProduct->getProductReference()->getClassName();
            $id = $cartProduct->getProductReference()->getForeignKey();
            
            if ($id == $newCartProduct->getProductReference()->getForeignKey() && $className == $newCartProduct->getProductReference()->getClassName())
            {
                $existingReference = $cartProduct;
                return $existingReference;
            }
        }
        
        return null;
        
    }
}
