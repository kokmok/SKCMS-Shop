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
class OrderStatusNotifications {
    
    
    private $container;
    private $twig;
    
    public function __construct(\Symfony\Component\DependencyInjection\Container $container,  \Twig_Environment $twig) 
    {
        $this->container = $container;
        $this->twig = $twig;
    }
    
    public function statusChanged(\SKCMS\ShopBundle\Events\OrderStatusChanged $event)
    {
//        die('status changed');
        $status = $event->getNewStatus();
        if ($status->getEmail() !== null)
        {
             $renderEvent = new \SKCMS\FrontBundle\Event\PreRenderEvent($this->container->get('request'));
            $this->container->get('event_dispatcher')
                ->dispatch(\SKCMS\FrontBundle\Event\SKCMSFrontEvents::PRE_RENDER, $renderEvent);
            
            $message = \Swift_Message::newInstance()
                ->setSubject($status->getEmail()->getSubject())
                ->setFrom($this->container->getParameter('mailer_user'))
                ->setTo($event->getOrder()->getUser()->getEmail())
                ->setBody(
                    $this->twig->render(
                            
                        'SKCMSShopBundle:Order/status/emails:'.$status->getEmail()->getTemplate().'.html.twig',['order'=>$event->getOrder()]
                    )
                    , 'text/html'
                )
            ;
            $this->container->get('mailer')->send($message);
        }
    }
    
    
}
