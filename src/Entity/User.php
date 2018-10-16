<?php
// src/Entity/User.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $adress;

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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Social", mappedBy="relation")
     */
    protected $socialUser;
    
       
    /**
     * @ORM\Column(type="boolean", options={"default":false}, nullable=true)
     */
    protected $onLineUser;

      /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255, nullable=true)
     */
    protected $company;

    /**
     * @var string
     *
     * @ORM\Column(name="short_bio", type="string", length=500, nullable=true)
     */
    protected $shortBio;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    protected $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     */
    protected $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     */
    protected $twitter;

    /**
     * @var string
     *
     * @ORM\Column(name="github", type="string", length=255, nullable=true)
     */
    protected $github;



    public function __construct()
    {
        parent::__construct();
        $this->socialUser = new ArrayCollection();
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

    /**
     * Get the value of social
     */ 
    public function getSocial()
    {
        return $this->social;
    }

    /**
     * Set the value of social
     *
     * @return  self
     */ 
    public function setSocial($social)
    {
        $this->social = $social;

        return $this;
    }

    /**
     * @return Collection|Social[]
     */
    public function getSocialUser(): Collection
    {
        return $this->socialUser;
    }

    public function addSocialUser(Social $socialUser): self
    {
        if (!$this->socialUser->contains($socialUser)) {
            $this->socialUser[] = $socialUser;
            $socialUser->setRelation($this);
        }

        return $this;
    }

    public function removeSocialUser(Social $socialUser): self
    {
        if ($this->socialUser->contains($socialUser)) {
            $this->socialUser->removeElement($socialUser);
            // set the owning side to null (unless already changed)
            if ($socialUser->getRelation() === $this) {
                $socialUser->setRelation(null);
            }
        }

        return $this;
    }

    /**
     * Get the value of onLineUser
     */ 
    public function getOnLineUser()
    {
        return $this->onLineUser;
    }

    /**
     * Set the value of onLineUser
     *
     * @return  self
     */ 
    public function setOnLineUser($onLineUser)
    {
        $this->onLineUser = $onLineUser;

        return $this;
    }

    /**
     * Get the value of adress
     */ 
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set the value of adress
     *
     * @return  self
     */ 
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get the value of title
     *
     * @return  string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  string  $title
     *
     * @return  self
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of company
     *
     * @return  string
     */ 
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set the value of company
     *
     * @param  string  $company
     *
     * @return  self
     */ 
    public function setCompany(string $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get the value of shortBio
     *
     * @return  string
     */ 
    public function getShortBio()
    {
        return $this->shortBio;
    }

    /**
     * Set the value of shortBio
     *
     * @param  string  $shortBio
     *
     * @return  self
     */ 
    public function setShortBio(string $shortBio)
    {
        $this->shortBio = $shortBio;

        return $this;
    }

    /**
     * Get the value of phone
     *
     * @return  string
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @param  string  $phone
     *
     * @return  self
     */ 
    public function setPhone(string $phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of facebook
     *
     * @return  string
     */ 
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set the value of facebook
     *
     * @param  string  $facebook
     *
     * @return  self
     */ 
    public function setFacebook(string $facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }


    /**
     * Get the value of twitter
     *
     * @return  string
     */ 
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set the value of twitter
     *
     * @param  string  $twitter
     *
     * @return  self
     */ 
    public function setTwitter(string $twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get the value of github
     *
     * @return  string
     */ 
    public function getGithub()
    {
        return $this->github;
    }

    /**
     * Set the value of github
     *
     * @param  string  $github
     *
     * @return  self
     */ 
    public function setGithub(string $github)
    {
        $this->github = $github;

        return $this;
    }
}