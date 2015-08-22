<?php

namespace SKCMS\ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
/**
 * Description of OrderDeliveryType
 *
 * @author jona
 */
class OrderAddressesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	
        $builder
            ->add('deliveryAddress',new \SKCMS\UserBundle\Form\AddressType)
            ->add('billingAddress',new \SKCMS\UserBundle\Form\AddressType)
        ;
    }
    
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SKCMS\ShopBundle\Entity\Order'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skcms_shopbundle_orderdelivery';
    }
}
