<?php

namespace SKCMS\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SKCMS\ShopBundle\Entity\CategoryRepository")
 */
class Category extends \SKCMS\CoreBundle\Entity\SKBaseEntity
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
     * @Gedmo\Translatable 
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="SKCMS\ShopBundle\Entity\SKBaseProduct",mappedBy="category")
     */
    protected $products;


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
     * @return Category
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
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Add products
     *
     * @param \SKCMS\ShopBundle\Entity\SKBaseProduct $products
     * @return Category
     */
    public function addProduct(\SKCMS\ShopBundle\Entity\SKBaseProduct $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \SKCMS\ShopBundle\Entity\SKBaseProduct $products
     */
    public function removeProduct(\SKCMS\ShopBundle\Entity\SKBaseProduct $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set userCreate
     *
     * @param \SKCMS\UserBundle\Entity\User $userCreate
     * @return Category
     */
    public function setUserCreate(\SKCMS\UserBundle\Entity\User $userCreate = null)
    {
        $this->userCreate = $userCreate;

        return $this;
    }

    /**
     * Get userCreate
     *
     * @return \SKCMS\UserBundle\Entity\User 
     */
    public function getUserCreate()
    {
        return $this->userCreate;
    }

    /**
     * Set userUpdate
     *
     * @param \SKCMS\UserBundle\Entity\User $userUpdate
     * @return Category
     */
    public function setUserUpdate(\SKCMS\UserBundle\Entity\User $userUpdate = null)
    {
        $this->userUpdate = $userUpdate;

        return $this;
    }

    /**
     * Get userUpdate
     *
     * @return \SKCMS\UserBundle\Entity\User 
     */
    public function getUserUpdate()
    {
        return $this->userUpdate;
    }
}
