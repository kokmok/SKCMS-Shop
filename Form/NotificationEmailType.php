<?php

namespace SKCMS\ShopBundle\Form;


use SKCMS\CoreBundle\Form\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NotificationEmailType extends \SKCMS\CoreBundle\Form\EntityType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('subject')
            ->add('template',null,['required'=>false])
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SKCMS\ShopBundle\Entity\NotificationEmail'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skcms_shopbundle_notificationemail';
    }
}
