<?php

namespace SKCMS\ShopBundle\Controller;

use SKCMS\ShopBundle\Controller\OrderController;

class FrontController extends OrderController
{
    
    public function myOrdersAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_CLIENT', null, 'Unable to access this page!');
        
        $repo = $this->getDoctrine()->getManager()->getRepository('SKCMSShopBundle:Order');
        $orders = $repo->findBy(['user'=>$this->getUser(),'conditionsAccepted'=>true],['date'=>'DESC']);
        
        
        return $this->render('SKCMSShopBundle:Order:list.html.twig',['orders'=>$orders]);
    
        
    }
    
    public function orderViewAction($orderId,\Symfony\Component\HttpFoundation\Request $request)
    {
        $order = $this->getOrder($orderId);
                
        
        return $this->render('SKCMSShopBundle:Order:view.html.twig',['order'=>$order]);
    
        
    }
    
    
    
}
