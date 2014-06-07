<?php

namespace IKTO\TestportalEmuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Subject
 * @package IKTO\TestportalEmuBundle\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="subject")
 */
class Subject
{
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @param int $id
     * @return Subject
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     * @return Subject
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
