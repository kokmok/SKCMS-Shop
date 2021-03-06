<?php

namespace SKCMS\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Promotion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SKCMS\ShopBundle\Entity\PromotionRepository")
 */
class Promotion extends \SKCMS\CoreBundle\Entity\SKBaseEntity
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
     * @ORM\Column(name="percent", type="integer",nullable=true)
     */
    private $percent;

    /**
     * @var integer
     *
     * @ORM\Column(name="xPlusOne", type="integer",nullable=true)
     */
    private $xPlusOne;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateStart", type="datetime")
     */
    private $dateStart;

                
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnd", type="datetime")
     */
    private $dateEnd;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
    
    /**
     *
     * @ORM\OneToOne(targetEntity="SKCMS\CoreBundle\Entity\SKImage",cascade={"all"})
     * 
     */
    private $picture;

    public function __toString() {
        return $this->name;
    }
    public function __construct() {
        parent::__construct();
        $this->dateEnd = new \DateTime();
        $this->dateStart = new \DateTime();
        
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
     * @return Promotion
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
     * Set percent
     *
     * @param integer $percent
     * @return Promotion
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;

        return $this;
    }

    /**
     * Get percent
     *
     * @return integer 
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * Set xPlusOne
     *
     * @param integer $xPlusOne
     * @return Promotion
     */
    public function setXPlusOne($xPlusOne)
    {
        $this->xPlusOne = $xPlusOne;

        return $this;
    }

    /**
     * Get xPlusOne
     *
     * @return integer 
     */
    public function getXPlusOne()
    {
        return $this->xPlusOne;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     * @return Promotion
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime 
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     * @return Promotion
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime 
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Promotion
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }
    
    public function isActive()
    {
        return $this->active;
    }
    
    public function getPicture()
    {
        return $this->picture;
    }
    
    public function setPicture(\SKCMS\CoreBundle\Entity\SKImage $picture)
    {
        $this->picture = $picture;
    }
}
