<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 14/09/18
 * Time: 11:31
 */

namespace Api\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package Api\Entity
 * @ORM\Entity()
 * @ORM\Table(name="user")
 * @ORM\HasLifecycleCallbacks()
 */
class User
{
    const ROLE_DEFAULT = 1;
    const ROLE_ADMIN = 2;
    /**
     * @var int $id
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $name
     * @ORM\Column(length=100, type="string")
     */
    private $name;

    /**
     * @var string $email
     * @ORM\Column(length=100, type="string", unique=true)
     */
    private $email;

    /**
     * @var string $password
     * @ORM\Column(length=255, type="string")
     */
    private $password;

    /**
     * @var int
     * @ORM\Column(type="integer", length=2)
     */
    private $role;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $registered;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->updated = new \DateTime();
    }

    public function prePersist()
    {
        $this->role = self::ROLE_DEFAULT;
        $this->registered = new \DateTime();
        $this->preUpdate();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return int
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param int $role
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getRegistered()
    {
        return $this->registered;
    }

    /**
     * @param \DateTime $registered
     * @return User
     */
    public function setRegistered($registered)
    {
        $this->registered = $registered;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     * @return User
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }


}