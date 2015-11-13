<?php

namespace SKCMS\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Delivery
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SKCMS\ShopBundle\Entity\DeliveryRepository")
 */
class Delivery extends \SKCMS\CoreBundle\Entity\SKBaseEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="delay", type="integer")
     */
    private $delay;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="SKCMS\ShopBundle\Entity\DeliveryRule", mappedBy="delivery",cascade={"all"})
     */
    private $rules;
    
    /**
     *
     * @var boolean
     * @ORM\Column(name="addressRequired",type="boolean")
     */
    private $addressRequired ;
    
    
    public function __toString() {
        return $this->name;
    }
    
    public function __construct() {
        parent::__construct();
        $this->rules = new \Doctrine\Common\Collections\ArrayCollection();
        $this->addressRequired = true;
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
     * Set name
     *
     * @param string $name
     * @return Delivery
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set delay
     *
     * @param integer $delay
     * @return Delivery
     */
    public function setDelay($delay)
    {
        $this->delay = $delay;

        return $this;
    }

    /**
     * Get delay
     *
     * @return integer 
     */
    public function getDelay()
    {
        return $this->delay;
    }
    
    public function getRules()
    {
        return $this->rules;
    }
    
    public function setRules(\Doctrine\Common\Collections\ArrayCollection $rules)
    {
        foreach ($rules as $rule)
        {
            $rule->setDelivery($this);
        }
        
        foreach ($this->rules as $rule)
        {
            if (!$rules->contains($rule))
            {
                $rule->setDelivery(null);
            }
        }
        
        $this->rules = $rules;
        
        return $this;
    }
    
    public function addRule(DeliveryRule $rule)
    {
        $this->rules->add($rule);
        $rule->setDelivery($this);
        return $this;
    }
    
    public function removeRule(DeliveryRule $rule)
    {
        $this->rules->removeElement($rule);
        return $this;
    }
    
    public function setAddressRequired($addressRequired)
    {
        $this->addressRequired = $addressRequired;
        return $this;
    }
    public function isAddressRequired()
    {
        return $this->addressRequired;
    }
    
}
