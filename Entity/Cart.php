<?php

namespace SKCMS\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cart
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SKCMS\ShopBundle\Entity\CartRepository")
 */
class Cart
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    
    /**
     * @ORM\OneToMany(targetEntity="SKCMS\ShopBundle\Entity\CartProduct", mappedBy="cart",cascade="all")
     */
    private $products;
    
    /**
     *
     * @ORM\OneToOne(targetEntity="SKCMS\ShopBundle\Entity\Order",mappedBy="cart")
     */
    private $order;

    
    public function __construct() {
        $this->date = new \DateTime();
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
        
    }
    

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
     * Set date
     *
     * @param \DateTime $date
     * @return Cart
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }
    
    public function getProducts()
    {
        return $this->products;
    }
    
    public function addProduct(CartProduct $product)
    {
        $this->products->add($product);
        return $this;
    }
    
    public function removeProduct(CartProduct $product)
    {
        $this->products->removeElement($product);
        return $this;
    }
    
    public function getTotal()
    {
        $total = 0;
        $currency = '€'; // Nasty but time is missing
        foreach ($this->products as $cartProduct)
        {
            $total += $cartProduct->getTotalHTVA();
            $currency = $cartProduct->getProduct()->getPrice()->getCurrency();
        }
        
        return $total.$currency;
    }
    public function getTotalTVACInt()
    {
        $total = 0;
        
        foreach ($this->products as $cartProduct)
        {
            $priceHTVA = $cartProduct->getProduct()->getPrice()->getAmount() * $cartProduct->getQuantity();
            $priceTVAC = $priceHTVA + ($priceHTVA * ($cartProduct->getProduct()->getVAT()->getValue()/100));
            $total += $cartProduct->getTotalTVAC();
        
        }
        
        return $total;
    }
    public function getTotalInt()
    {
        $total = 0;
        
        foreach ($this->products as $cartProduct)
        {
            $total += $cartProduct->getTotalHTVA();
        
        }
        
        return $total;
    }
    
    public function getOrder()
    {
        return $this->order;
    }
    
    public function setOrder(Order $order)
    {
        $this->order = $order;
        return $this;
    }
    public function getWeight()
    {
        $weight = 0;
        foreach ($this->getProducts() as $cartProduct)
        {
            $product = $cartProduct->getProduct();
            if ($product->getWeight() !== null)
            {
                $weight += $product->getWeight();
            }
        }
        
        return $weight;
    }
    
    public function __clone()
    {
        $this->id = null;
        $this->date = new \DateTime();
    }
}
