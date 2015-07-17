<?php

namespace SKCMS\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CartStatus
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SKCMS\ShopBundle\Entity\CommandStatusRepository")
 */
class CommandStatus extends \SKCMS\CoreBundle\Entity\SKBaseEntity
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
    /**
     * @var \DateTime
     */
    private $creationDate;

    /**
     * @var \DateTime
     */
    private $updateDate;

    /**
     * @var boolean
     */
    private $draft;

    /**
     * @var \SKCMS\UserBundle\Entity\User
     */
    private $userCreate;

    /**
     * @var \SKCMS\UserBundle\Entity\User
     */
    private $userUpdate;


    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return CommandStatus
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime 
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set updateDate
     *
     * @param \DateTime $updateDate
     * @return CommandStatus
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get updateDate
     *
     * @return \DateTime 
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * Set draft
     *
     * @param boolean $draft
     * @return CommandStatus
     */
    public function setDraft($draft)
    {
        $this->draft = $draft;

        return $this;
    }

    /**
     * Get draft
     *
     * @return boolean 
     */
    public function getDraft()
    {
        return $this->draft;
    }

    /**
     * Set userCreate
     *
     * @param \SKCMS\UserBundle\Entity\User $userCreate
     * @return CommandStatus
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
     * @return CommandStatus
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
