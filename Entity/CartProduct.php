<?php

namespace SKCMS\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CartProduct
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CartProduct
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;
    
    /**
     * @ORM\ManyToOne(targetEntity="SKCMS\ShopBundle\Entity\Cart", inversedBy="products")
     */
    private $cart;
    
    /**
     * @ORM\ManyToOne(targetEntity="SKCMS\CoreBundle\Entity\EntityReference",cascade="all")
     */
    private $productReference;
    
    private $product;
    
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return CartProduct
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set cart
     *
     * @param \SKCMS\ShopBundle\Entity\Cart $cart
     * @return CartProduct
     */
    public function setCart(\SKCMS\ShopBundle\Entity\Cart $cart = null)
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * Get cart
     *
     * @return \SKCMS\ShopBundle\Entity\Cart 
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * Set product
     *
     * @param \SKCMS\ShopBundle\Entity\Product $product
     * @return CartProduct
     */
    public function setProduct(\SKCMS\ShopBundle\Entity\Product $product = null)
    {
        $this->product = $product;
        
        return $this;
    }

    /**
     * Get product
     *
     * @return \SKCMS\ShopBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set productReference
     *
     * @param \SKCMS\CoreBundle\Entity\EntityReference $productReference
     * @return CartProduct
     */
    public function setProductReference(\SKCMS\CoreBundle\Entity\EntityReference $productReference = null)
    {
        $this->productReference = $productReference;

        return $this;
    }

    /**
     * Get productReference
     *
     * @return \SKCMS\CoreBundle\Entity\EntityReference 
     */
    public function getProductReference()
    {
        return $this->productReference;
    }
    
    
    public function onLoad()
    {
        $this->setProduct($this->productReference->getEntity()); 
    }
}
