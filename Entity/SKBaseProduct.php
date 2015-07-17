<?php
namespace SKCMS\ShopBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use SKCMS\CoreBundle\Entity\SKBaseEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use SKCMS\CoreBundle\Slug\SKSlug as SKSlug;


/** 
 * @ORM\MappedSuperclass 
 *
 * 
 */

class SKBaseProduct extends SKBaseEntity{
    /**
     * @Gedmo\Slug(fields={"title"},updatable=false)
     * @Gedmo\Translatable
     * @ORM\Column(length=128)
     * 
     */
    protected $slug; 

    /**
     * 
     * @ORM\Column(type="string")
     * @Gedmo\Translatable
     */
    protected $title;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="SKCMS\ShopBundle\Entity\Category",inversedBy="products")
     */
    protected $category;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="SKCMS\ShopBundle\Entity\Price",mappedBy="product")
     */
    protected $prices;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="SKCMS\ShopBundle\Entity\Promotion")
     */
    protected $promotion;
    /**
     *
     * @ORM\ManyToOne(targetEntity="SKCMS\ShopBundle\Entity\VAT")
     */
    protected $vat;
    

    
    public function __construct()
    {
        parent::__construct();
        $this->prices = new \Doctrine\Common\Collections\ArrayCollection();
        
    }
    
    public function __toString()
    {
        return $this->title;
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
     * Set title
     *
     * @param string $title
     * @return Page
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
    
    public function getSlug()
    {
        return $this->slug;
    }
    
    public function setCategory(Category $category)
    {
        $this->category = $category;
        return $this;
    }
    
    public function getCategory()
    {
        return $this->category;
    }
    
    public function addPrice(Price $price)
    {
        $this->prices->add($price);
        return $this;
    }
    public function removePrice(Price $price)
    {
        $this->prices->remove($price);
        return $this;
    }
    public function getPrices()
    {
        return $this->prices;
    }
    
    public function setPromotion(Promotion $promotion)
    {
        $this->promotion = $promotion;
        return $this;
    }
    
    public function getPromotion()
    {
        return $this->promotion;
    }
    
    public function setVat(VAT $vat)
    {
        $this->vat = $vat;
        return $this;
    }
    
    public function getVat()
    {
        return $this->vat;
    }

    
}
