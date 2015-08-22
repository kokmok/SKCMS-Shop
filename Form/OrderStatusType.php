<?php

namespace SKCMS\ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrderStatusType extends \SKCMS\CoreBundle\Form\EntityType
{
    
    private $emailsTemplates;
    
    public function __construct() 
    {
//        $this->emailsTemplates = [];
//        $emailsForlder =   \SKCMS\ShopBundle\Entity\OrderStatus::getEmailsPath();
//        if ($handle = opendir($emailsForlder)) {
//            
//            while (false !== ($entry = readdir($handle))) {
//                $this->emailsTemplates[$entry]= $entry ;
//            }
//
//            
//            closedir($handle);
//        }
//        

    }
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	parent::buildForm($builder, $options);
        $builder
            ->add('name')
            ->add('payed',null,['required'=>false])
            ->add('closed',null,['required'=>false])
            ->add('default',null,['required'=>false])
            ->add('email')
            ->add('color','skcms_colorpicker')
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SKCMS\ShopBundle\Entity\OrderStatus'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skcms_shopbundle_orderstatus';
    }
}
