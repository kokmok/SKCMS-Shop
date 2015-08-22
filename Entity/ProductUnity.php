<?php

namespace SKCMS\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductUnity
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SKCMS\ShopBundle\Entity\ProductUnityRepository")
 */
class ProductUnity extends \SKCMS\CoreBundle\Entity\SKBaseEntity
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
     * @ORM\Column(name="floatableLevel", type="integer")
     */
    private $floatableLevel;

    /**
     * @var string
     *
     * @ORM\Column(name="abreviation", type="string", length=255)
     */
    private $abreviation;

    
    public function __toString()
    {
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
     * @return ProductUnity
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
     * Set floatableLevel
     *
     * @param integer $floatableLevel
     * @return ProductUnity
     */
    public function setFloatableLevel($floatableLevel)
    {
        $this->floatableLevel = $floatableLevel;

        return $this;
    }

    /**
     * Get floatableLevel
     *
     * @return integer 
     */
    public function getFloatableLevel()
    {
        return $this->floatableLevel;
    }

    /**
     * Set abreviation
     *
     * @param string $abreviation
     * @return ProductUnity
     */
    public function setAbreviation($abreviation)
    {
        $this->abreviation = $abreviation;

        return $this;
    }

    /**
     * Get abreviation
     *
     * @return string 
     */
    public function getAbreviation()
    {
        return $this->abreviation;
    }
}
