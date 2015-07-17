<?php

namespace SKCMS\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatusLog
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CommandStatusLog
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
     *
     * @ORM\ManyToOne(targetEntity="SKCMS\ShopBundle\Entity\CommandStatus")
     */
    private $status;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="SKCMS\ShopBundle\Entity\Command", inversedBy="statusLogs")
     */
    private $command;

    
    public function __construct() 
    {
        $this->date = new \DateTime();
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
     * @return StatusLog
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
     * Set status
     *
     * @param \SKCMS\ShopBundle\Entity\CommandStatus $status
     * @return CartStatusLog
     */
    public function setStatus(\SKCMS\ShopBundle\Entity\CommandStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \SKCMS\ShopBundle\Entity\CommandStatus 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set command
     *
     * @param \SKCMS\ShopBundle\Entity\Command $command
     * @return CartStatusLog
     */
    public function setCommand(\SKCMS\ShopBundle\Entity\Command $command = null)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * Get command
     *
     * @return \SKCMS\ShopBundle\Entity\Command 
     */
    public function getCommand()
    {
        return $this->command;
    }
}
