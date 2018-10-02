<?php
// src/Entity/User.php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="integer", length=6, options={"default":0})
     */
    protected $loginCount = 0;
 
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $firstLogin; 

    
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Get the value of firstLogin
     *
     * @return  \DateTime
     */ 
    public function getFirstLogin()
    {
        return $this->firstLogin;
    }

    /**
     * Set the value of firstLogin
     *
     * @param  \DateTime  $firstLogin
     *
     * @return  self
     */ 
    public function setFirstLogin(\DateTime $firstLogin)
    {
        $this->firstLogin = $firstLogin;

        return $this;
    }

    /**
     * Get the value of loginCount
     */ 
    public function getLoginCount()
    {
        return $this->loginCount;
    }

    /**
     * Set the value of loginCount
     *
     * @return  self
     */ 
    public function setLoginCount($loginCount)
    {
        $this->loginCount = $loginCount;

        return $this;
    }
}