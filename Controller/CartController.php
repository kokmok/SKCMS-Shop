<?php

namespace SKCMS\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CartController extends Controller
{
    private $callBackParams;
    
    public function __construct() {
        $this->callBackParams = [];
    }
    public function addProductAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $cartUtils = $this->get('skcms_shop.cartutils');
        $productUtils = $this->get('skcms_shop.productutils');
        $productUtils->addProductFromRequest($request);
        
        
        
        $this->customResponseData();
        
        
        $responseData = ['success'=>1,'callBackParams'=>$this->callBackParams];
        
        
        $response = new \Symfony\Component\HttpFoundation\JsonResponse($responseData);
        $response->headers->setCookie(new \Symfony\Component\HttpFoundation\Cookie('cartId',$cartUtils->getCurrentCart()->getId()));
        
        return $response;
    
        
    }
    public function removeProductJsonAction($cartProductId)
    {
        $cartUtils = $this->get('skcms_shop.cartutils');
        $productUtils = $this->get('skcms_shop.productutils');
        $cartUtils->removeProductById($cartProductId);
        
        
        
        
        $this->customResponseData();
        
        $responseData = ['success'=>1,'callBackParams'=>$this->callBackParams];
        
        
        $response = new \Symfony\Component\HttpFoundation\JsonResponse($responseData);
        $response->headers->setCookie(new \Symfony\Component\HttpFoundation\Cookie('cartId',$cartUtils->getCurrentCart()->getId()));
        
        return $response;
    
        
    }
    
    protected function addResponseData($key,$value)
    {
        $this->callBackParams[$key] = $value;
    }
    
    protected function customResponseData()
    {
        
        
    }
}
