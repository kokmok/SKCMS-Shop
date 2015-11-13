<?php

namespace SKCMS\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CartProduct
 *
 * @ORM\Table()
 * @ORM\Entity
 * 
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
     * @ORM\Column(name="quantity", type="float")
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
     *
     * @var text
     * @ORM\Column(name="comment",type="text",nullable=true)
     */
    private $comment;
    
    

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
        $this->cart->addProduct($this);
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
     * Get comment
     *
    */
    public function getComment()
    {
        return $this->comment;
    }
    
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
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
        $this->product = $productReference->getEntity();
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
    
    public function getProduct()
    {
        return $this->productReference->getEntity();
    }
    
    public function setProduct(SKBaseProduct $product)
    {
        $this->product = $product;
        return $this;
    }
    
    public function getTotal()
    {
        if ($this->getProduct() !== null)
        {
            return $this->getProduct()->getPrice()->getAmount() * $this->quantity .' '.$this->getProduct()->getPrice()->getCurrency();
        }
        return null;
    }
    public function getTotalHTVA()
    {
        if ($this->getProduct() !== null)
        {
            $quantity = $this->quantity;
            $amount = $this->getProduct()->getPrice()->getAmount();
            if ( \SKCMS\FrontBundle\Twig\SKCMSAdminExtension::validPromotion($this->getProduct()->getPromotion()))
            {
                if ($this->getProduct()->getPromotion()->getXPlusOne() !== null)
                {
                    $quantity -= floor($this->quantity/($this->getProduct()->getPromotion()->getXPlusOne()+1));
                }
                else if ($this->getProduct()->getPromotion()->getPercent() !== null)
                {
                    $amount *= ((100-$this->getProduct()->getPromotion()->getPercent())/100);
                }
                
            }
            $price =  $amount* $quantity;
            return $price;
        }
        return null;
    }
    
    public function getTotalTVAC()
    {
        $htva = $this->getTotalHTVA();
        $tvac = $htva + ($htva * ($this->getProduct()->getVAT()->getValue()/100));
        return $tvac;
    }
    
    
}
