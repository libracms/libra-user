<?php

namespace LibraUser\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Role
 *
 * @author duke
 *
 * @ORM\Entity
 * @ORM\Table(name="role")
 */
class Role
{
    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(length=15, unique=true)
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(type="integer", name="parent_id")
     * @var string
     */
    protected $parentId;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="roles")
     * @var ArrayCollection
     */
    protected $users;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
