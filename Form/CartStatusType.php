<?php

namespace SKCMS\ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CartStatusType extends \SKCMS\CoreBundle\Form\EntityType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	parent::buildForm($builder, $options);
        $builder
            ->add('name')
            ->add('payed')
            ->add('closed')
            ->add('creationDate')
            ->add('updateDate')
            ->add('draft')
            ->add('userCreate')
            ->add('userUpdate')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SKCMS\ShopBundle\Entity\CartStatus'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skcms_shopbundle_cartstatus';
    }
}
