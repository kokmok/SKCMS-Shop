<?php

namespace SKCMS\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CartStatus
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SKCMS\ShopBundle\Entity\OrderStatusRepository")
 */
class OrderStatus extends \SKCMS\CoreBundle\Entity\SKBaseEntity
{
    
    const EMAILS_PATH = '/views/Order/status/emails/';
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
     * @var boolean
     *
     * @ORM\Column(name="payed", type="boolean")
     */
    private $payed;

    /**
     * @var boolean
     *
     * @ORM\Column(name="closed", type="boolean")
     */
    private $closed;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="default_status", type="boolean")
     */
    private $default;
    
    /**
     *
     * @var string
     * @ORM\Column(name="color",type="string",length=50) 
     */
    private $color;
    
    /**
     *
     * 
     * @ORM\ManyToOne(targetEntity="SKCMS\ShopBundle\Entity\NotificationEmail")
     */
    private $email;

    
    public function __toString() {
        return $this->name;
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
     * @return CartStatus
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
     * Set payed
     *
     * @param boolean $payed
     * @return CartStatus
     */
    public function setPayed($payed)
    {
        $this->payed = $payed;

        return $this;
    }

    /**
     * Get payed
     *
     * @return boolean 
     */
    public function getPayed()
    {
        return $this->payed;
    }
    public function isPayed()
    {
        return $this->payed;
    }

    /**
     * Set closed
     *
     * @param boolean $closed
     * @return CartStatus
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;

        return $this;
    }

    /**
     * Get closed
     *
     * @return boolean 
     */
    public function getClosed()
    {
        return $this->closed;
    }
    public function isClosed()
    {
        return $this->closed;
    }

    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }

    /**
     * Get default
     *
     * @return boolean 
     */
    public function getDefault()
    {
        return $this->default;
    }
    public function isDefault()
    {
        return $this->default;
    }
    
    public function getColor()
    {
        return $this->color;
    }
    
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail(NotificationEmail $email)
    {
        $this->email = $email;
        return $this;
    }
    
    public static function getEmailsPath()
    {
        return __DIR__.'/../Resources'.self::EMAILS_PATH;
    }
}