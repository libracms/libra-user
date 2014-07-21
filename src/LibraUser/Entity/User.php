<?php

namespace LibraUser\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ZfcRbac\Identity\IdentityInterface;
use ZfcUser\Entity\User as BaseUser;

/**
 * Description of User
 *
 * @author duke
 *
 * @ORM\Entity(repositoryClass="LibraUser\Repository\User")
 * @ORM\Table(name="user")
 * //name="user_role_linker
 */
class User extends BaseUser implements IdentityInterface
{
    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(unique=true, nullable=true)
     * @var string
     */
    protected $username;

    /**
     * @ORM\Column(unique=true, nullable=true)
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column(length=50, nullable=true, name="display_name")
     * @var string
     */
    protected $displayName;

    /**
     * @ORM\Column(length=128)
     * @var string
     */
    protected $password;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     * @var int
     */
    protected $state;

    /**
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="users")
     * @var ArrayCollection
     */
    protected $roles;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

    public function getRoles()
    {
        return $this->roles;
    }
}
