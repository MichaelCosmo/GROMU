<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 30/06/2015
 * Time: 16:50
 */

namespace bddBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
/**
 * @ORM\Entity
 * @ORM\Table(name="commentaryClass")
 */
// src/bddBundle/Entity/commentaryClass.php

class commentaryClass
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     */
    protected $text;

    /**
     * @ManyToOne(targetEntity="messageClass")
     * @JoinColumn(name="fk_message", referencedColumnName="id")
     */
    protected $messageId;

    /**
     * @ManyToOne(targetEntity="userClass")
     * @JoinColumn(name="fk_login", referencedColumnName="login")
     */
    protected $user_login;

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
     * Set text
     *
     * @param string $text
     * @return commentaryClass
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set message_id
     *
     * @param \bddBundle\Entity\messageClass $messageId
     * @return commentaryClass
     */
    public function setMessageId(\bddBundle\Entity\messageClass $messageId = null)
    {
        $this->messageId = $messageId;
    
        return $this;
    }

    /**
     * Get message_id
     *
     * @return \bddBundle\Entity\messageClass 
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * Set user_login
     *
     * @param \bddBundle\Entity\userClass $userLogin
     * @return commentaryClass
     */
    public function setUserLogin(\bddBundle\Entity\userClass $userLogin = null)
    {
        $this->user_login = $userLogin;
    
        return $this;
    }

    /**
     * Get user_login
     *
     * @return \bddBundle\Entity\userClass 
     */
    public function getUserLogin()
    {
        return $this->user_login;
    }
}
