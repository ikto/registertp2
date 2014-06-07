<?php

namespace IKTO\TestportalEmuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Certificate
 * @package IKTO\TestportalEmuBundle\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="data")
 */
class Certificate
{
    /**
     * @var integer
     * @ORM\Column(type="integer", name="id_pk")
     * @ORM\Id
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=4)
     */
    protected $year;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=7)
     */
    protected $number;

    /**
     * @var string
     * @ORM\Column(type="string", length=4)
     */
    protected $pin;

    /**
     * @var Subject
     * @ORM\ManyToOne(targetEntity="Subject")
     */
    protected $subject1;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    protected $value1 = 0;

    /**
     * @var Subject
     * @ORM\ManyToOne(targetEntity="Subject")
     */
    protected $subject2;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    protected $value2 = 0;

    /**
     * @var Subject
     * @ORM\ManyToOne(targetEntity="Subject")
     */
    protected $subject3;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    protected $value3 = 0;

    /**
     * @var Subject
     * @ORM\ManyToOne(targetEntity="Subject")
     */
    protected $subject4;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    protected $value4 = 0;

    /**
     * @var Subject
     * @ORM\ManyToOne(targetEntity="Subject")
     */
    protected $subject5;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    protected $value5 = 0;

    /**
     * @param int $id
     * @return Certificate
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
     * @param string $year
     * @return Certificate
     */
    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    /**
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param string $name
     * @return Certificate
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

    /**
     * @param string $number
     * @return Certificate
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $pin
     * @return Certificate
     */
    public function setPin($pin)
    {
        $this->pin = $pin;
        return $this;
    }

    /**
     * @return string
     */
    public function getPin()
    {
        return $this->pin;
    }

    /**
     * @param Subject $subject1
     * @return Certificate
     */
    public function setSubject1($subject1)
    {
        $this->subject1 = $subject1;
        return $this;
    }

    /**
     * @return Subject
     */
    public function getSubject1()
    {
        return $this->subject1;
    }

    /**
     * @param float $value1
     * @return Certificate
     */
    public function setValue1($value1)
    {
        $this->value1 = $value1;
        return $this;
    }

    /**
     * @return float
     */
    public function getValue1()
    {
        return $this->value1;
    }

    /**
     * @param Subject $subject2
     * @return Certificate
     */
    public function setSubject2($subject2)
    {
        $this->subject2 = $subject2;
        return $this;
    }

    /**
     * @return Subject
     */
    public function getSubject2()
    {
        return $this->subject2;
    }

    /**
     * @param float $value2
     * @return Certificate
     */
    public function setValue2($value2)
    {
        $this->value2 = $value2;
        return $this;
    }

    /**
     * @return float
     */
    public function getValue2()
    {
        return $this->value2;
    }

    /**
     * @param Subject $subject3
     * @return Certificate
     */
    public function setSubject3($subject3)
    {
        $this->subject3 = $subject3;
        return $this;
    }

    /**
     * @return Subject
     */
    public function getSubject3()
    {
        return $this->subject3;
    }

    /**
     * @param float $value3
     * @return Certificate
     */
    public function setValue3($value3)
    {
        $this->value3 = $value3;
        return $this;
    }

    /**
     * @return float
     */
    public function getValue3()
    {
        return $this->value3;
    }

    /**
     * @param Subject $subject4
     * @return Certificate
     */
    public function setSubject4($subject4)
    {
        $this->subject4 = $subject4;
        return $this;
    }

    /**
     * @return Subject
     */
    public function getSubject4()
    {
        return $this->subject4;
    }

    /**
     * @param float $value4
     * @return Certificate
     */
    public function setValue4($value4)
    {
        $this->value4 = $value4;
        return $this;
    }

    /**
     * @return float
     */
    public function getValue4()
    {
        return $this->value4;
    }

    /**
     * @param Subject $subject5
     * @return Certificate
     */
    public function setSubject5($subject5)
    {
        $this->subject5 = $subject5;
        return $this;
    }

    /**
     * @return Subject
     */
    public function getSubject5()
    {
        return $this->subject5;
    }

    /**
     * @param float $value5
     * @return Certificate
     */
    public function setValue5($value5)
    {
        $this->value5 = $value5;
        return $this;
    }

    /**
     * @return float
     */
    public function getValue5()
    {
        return $this->value5;
    }
}
