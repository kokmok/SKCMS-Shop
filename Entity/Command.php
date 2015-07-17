<?php

namespace SKCMS\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Command
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SKCMS\ShopBundle\Entity\CommandRepository")
 */
class Command
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
     * @var float
     *
     * @ORM\Column(name="feeHTVA", type="float")
     */
    private $feeHTVA;

    /**
     * @var float
     *
     * @ORM\Column(name="feeTVAC", type="float")
     */
    private $feeTVAC;
    
    /**
     * @ORM\ManyToOne(targetEntity="SKCMS\ShopBundle\Entity\CommandStatus")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="SKCMS\ShopBundle\Entity\CommandStatusLog", mappedBy="command")
     */
    private $statusLogs;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="SKCMS\UserBundle\Entity\User")
     */
    private $user;

    /**
     *
     * @ORM\ManyToOne(targetEntity="SKCMS\ShopBundle\Entity\Delivery")
     */
    private $delivery;
    
    
    public function __construct() {
        $this->date = new \DateTime();
        $this->statusLogs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->feeHTVA = 0;
        $this->feeTVAC = 0;
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
     * @return Command
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

    /**
     * Set feeHTVA
     *
     * @param float $feeHTVA
     * @return Command
     */
    public function setFeeHTVA($feeHTVA)
    {
        $this->feeHTVA = $feeHTVA;

        return $this;
    }

    /**
     * Get feeHTVA
     *
     * @return float 
     */
    public function getFeeHTVA()
    {
        return $this->feeHTVA;
    }

    /**
     * Set feeTVAC
     *
     * @param float $feeTVAC
     * @return Command
     */
    public function setFeeTVAC($feeTVAC)
    {
        $this->feeTVAC = $feeTVAC;

        return $this;
    }

    /**
     * Get feeTVAC
     *
     * @return float 
     */
    public function getFeeTVAC()
    {
        return $this->feeTVAC;
    }

    /**
     * Set status
     *
     * @param \SKCMS\ShopBundle\CommandStatus $status
     * @return Command
     */
    public function setStatus(\SKCMS\ShopBundle\CommandStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \SKCMS\ShopBundle\CommandStatus 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Add statusLogs
     *
     * @param \SKCMS\ShopBundle\Entity\CommandStatusLog $statusLogs
     * @return Command
     */
    public function addStatusLog(\SKCMS\ShopBundle\Entity\CommandStatusLog $statusLogs)
    {
        $this->statusLogs[] = $statusLogs;

        return $this;
    }

    /**
     * Remove statusLogs
     *
     * @param \SKCMS\ShopBundle\Entity\CommandStatusLog $statusLogs
     */
    public function removeStatusLog(\SKCMS\ShopBundle\Entity\CommandStatusLog $statusLogs)
    {
        $this->statusLogs->removeElement($statusLogs);
    }

    /**
     * Get statusLogs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStatusLogs()
    {
        return $this->statusLogs;
    }

    /**
     * Set user
     *
     * @param \SKCMS\UserBundle\Entity\User $user
     * @return Command
     */
    public function setUser(\SKCMS\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \SKCMS\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set delivery
     *
     * @param \SKCMS\ShopBundle\Entity\Delivery $delivery
     * @return Command
     */
    public function setDelivery(\SKCMS\ShopBundle\Entity\Delivery $delivery = null)
    {
        $this->delivery = $delivery;

        return $this;
    }

    /**
     * Get delivery
     *
     * @return \SKCMS\ShopBundle\Entity\Delivery 
     */
    public function getDelivery()
    {
        return $this->delivery;
    }
}
