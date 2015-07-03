<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 30/06/2015
 * Time: 16:47
 */

namespace bddBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="userClass")
 */
// src/bddBundle/Entity/userClass.php
class userClass {

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=100)
     */
    protected $login;

    /**
     * @ORM\Column(type="text")
     */
    protected $password;

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }
    public function setLogin($login)
    {
        $this->login= $login;
        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return userClass
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }
}
