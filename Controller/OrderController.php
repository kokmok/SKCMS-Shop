<?php
namespace SKCMS\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use SKCMS\ShopBundle\Entity\Order;
/**
 * Description of OrderController
 *
 * @author jona
 */
class OrderController extends Controller{
    
    public function validateCartAction($cartId,$goBack,\Symfony\Component\HttpFoundation\Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_CLIENT', null, 'Unable to access this page!');
        
        
        if ($cartId === null)
        {
            $cartUtils = $this->get('skcms_shop.cartutils');
            $cart = $cartUtils->getCurrentCart();
        }
        else
        {
            $cartRepo = $this->getDoctrine()->getManager()->getRepository('SKCMSShopBundle:Cart');
            $cart = $cartRepo->find($cartId);
            
            if ($cart ===null)
            {
                throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
            }
            if ($cart->getOrder()->getUser() != $this->getUser())
            {
                throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
            }
        }
        
        if ($cart->getOrder() !== null && !$this->isValidOrder($cart->getOrder()))
        {
            return $this->inValidOrder($cart->getOrder()->getId());
        }
        
        
        
        $form = $this->createForm(new \SKCMS\ShopBundle\Form\CartType(),$cart);
        
        if ($request->getMethod() == 'POST')
        {

            if ($cart->getOrder() === null)
            {
                $order = new Order();
                $order->setUser($this->getUser());
                $order->setCart($cart);
                $cart->setOrder($order);
                $em= $this->getDoctrine()->getManager();
                
                
                
                $em->persist($order);
                $em->persist($cart);
                
                $em->flush();
                
            }
            
            if ($goBack === 'confirm')
            {
                $url = $this->generateUrl('skcms_shop_orderconfirm',['orderId'=>$cart->getOrder()->getId()]);
            }
            else
            {
                $url = $this->generateUrl('skcms_shop_orderdelivery',['orderId'=>$cart->getOrder()->getId()]);
            }
            
            return $this->redirect($url);
        }
        
                
        
        return $this->render('SKCMSShopBundle:Order:cart.html.twig',['form'=>$form->createView(),'cart'=>$cart]);
    }
    
    public function deliveryAction($orderId,$goBack,\Symfony\Component\HttpFoundation\Request $request)
    {
        
        
        $order = $this->getOrder($orderId);
        
        
        if (!$this->isValidOrder($order))
        {
            return $this->inValidOrder($orderId);
        }
        
        $form = $this->createForm(new \SKCMS\ShopBundle\Form\OrderDeliveryType(),$order);
        
        
        if ($request->getMethod() == 'POST' )
        {
            $form->handleRequest($request);
            
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($order);
                $em->flush();
                
                if ($order->getDelivery()->isAddressRequired())
                {
                    $url = $this->generateUrl('skcms_shop_orderaddresses',['orderId'=>$order->getId()]);
                }
                else
                {
                    $url = $this->generateUrl('skcms_shop_orderconfirm',['orderId'=>$order->getId()]);
                }
                
                if ($goBack === 'confirm')
                {
                    $url = $this->generateUrl('skcms_shop_orderconfirm',['orderId'=>$order->getId()]);
                }
                
                return $this->redirect($url);
                
            }
            
            
        }
        
        
        
        
        
        
        return $this->render('SKCMSShopBundle:Order:delivery.html.twig',['form'=>$form->createView()]);
    }
    
    public function addressesAction($orderId,$goBack,\Symfony\Component\HttpFoundation\Request $request)
    {
        $order = $this->getOrder($orderId);
        
        if (!$this->isValidOrder($order))
        {
            return $this->inValidOrder($orderId);
        }
        
        $addresses = $this->getUser()->getAddresses();
        if ($order->getDeliveryAddress() === null)
        {
            $deliveryAddress = clone $addresses[0];
            $deliveryAddress->resetId(null);
            $order->setDeliveryAddress($deliveryAddress);
        }
        if ($order->getBillingAddress() === null)
        {
            $billingAddress = clone $addresses[0];
            $billingAddress->resetId(null);
            $order->setBillingAddress($billingAddress);
        }
        
        
        
        
        
        $form = $this->createForm(new \SKCMS\ShopBundle\Form\OrderAddressesType(),$order);
        
        if ($request->getMethod() == 'POST')
        {
            $form->handleRequest($request);
            if ($form->isValid())
            {
                $this->getDoctrine()->getManager()->persist($order);
                $this->getDoctrine()->getManager()->flush();
                
                $url = $this->generateUrl('skcms_shop_orderconfirm',['orderId'=>$order->getId()]);
                if ($goBack === 'confirm')
                {
                    $url = $this->generateUrl('skcms_shop_orderconfirm',['orderId'=>$order->getId()]);
                }
                return $this->redirect($url);
            }
            
        }
        
        
        
        return $this->render('SKCMSShopBundle:Order:addresses.html.twig',['form'=>$form->createView()]);
    }
    
    
    public function confirmAction($orderId,  \Symfony\Component\HttpFoundation\Request $request)
    {
        $order = $this->getOrder($orderId);
        
        if (!$this->isValidOrder($order))
        {
            return $this->inValidOrder($orderId);
        }
        
        $form = $this->createForm(new \SKCMS\ShopBundle\Form\OrderConditionsType(),$order);
        
        if ($request->getMethod() == 'POST')
        {
            $form->handleRequest($request);
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $repo = $em->getRepository('SKCMSShopBundle:OrderStatus');
                $defaultStatus = $repo->findOneBy(['default'=>true]);
                
                if ($defaultStatus !== null)
                {
                    $order->setStatus($defaultStatus);
                }
                $order->processTotalTVAC();
                $order->processTotalHTVA();

                
                $this->getDoctrine()->getManager()->persist($order);
                $this->getDoctrine()->getManager()->flush($order);
                
                $url = $this->generateUrl('skcms_shop_orderconfirmed',['orderId'=>$orderId]);
                return $this->redirect($url);
                
            }
           
        }
        $response = $this->render('SKCMSShopBundle:Order:confirm.html.twig',['form'=>$form->createView(),'order'=>$order]);
        $response->headers->setCookie(new \Symfony\Component\HttpFoundation\Cookie('cartId',null));
        return $response;
    }
    
    private function cloneProducts($products,$newCart)
    {
        $newProducts = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($products as $product)
        {
//            dump($newCart);
            $newProduct = clone $product;
           
            $newProducts->add($newProduct);
        }
        
        dump($newProducts);
        
        return $newProducts;
                
    }
    
    public function duplicateAction($orderId)
    {
        $order = $this->getOrder($orderId);
        
        $newOrder = clone $order;
        $newCart = clone $order->getCart();
        
        $this->cloneProducts($order->getCart()->getProducts(),$newCart);
        
        dump($newCart);
        
        
//        $newOrder->setStatus(null);
//        $newOrder->setStatusLog(new \Doctrine\Common\Collections\ArrayCollection());
//        
//        $newOrder->resetId(null);
//        $newOrder->setDate(new \DateTime());
//        $newOrder->setConditionsAccepted(false);
//        
        
        dump($newOrder);
        die();
        $this->getDoctrine()->getManager()->persist($newOrder);
        $this->getDoctrine()->getManager()->flush();
        
        
        
        return $this->render('SKCMSShopBundle:Order:confirmed.html.twig');
         
    }
    public function confirmedAction($orderId)
    {
        $order = $this->getOrder($orderId);
        
        return $this->render('SKCMSShopBundle:Order:confirmed.html.twig');
         
    }
    
    private function invalidOrder($orderId)
    {
        $url = $this->generateUrl('skcms_shop_orderconfirmed',['orderId'=>$orderId]);
        return $this->redirect($url);
    }
    
    
    
    
    
    public function render($view, array $parameters = array(), \Symfony\Component\HttpFoundation\Response $response = null) {
        $event = new \SKCMS\FrontBundle\Event\PreRenderEvent($this->getRequest());
        $this->get('event_dispatcher')
            ->dispatch(\SKCMS\FrontBundle\Event\SKCMSFrontEvents::PRE_RENDER, $event);
        
        return parent::render($view, $parameters, $response);
    }
    
    private function isValidOrder(Order $order)
    {
        if ($order->isConditionsAccepted())
        {
            return false;
        }
        return true;
    }
    
    protected function getOrder($orderId)
    {
        $this->denyAccessUnlessGranted('ROLE_CLIENT', null, 'Unable to access this page!');
        
        $orderRepo = $this->getDoctrine()->getManager()->getRepository('SKCMSShopBundle:Order');
        $order = $orderRepo->find($orderId);
        
       
        
        if (null == $order)
        {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        }
        if ($order->getUser() != $this->getUser())
        {
            throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
        }
        
        return $order;
    }
    
    
}
