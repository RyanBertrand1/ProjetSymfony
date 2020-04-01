<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentLoanRepository")
 */
class StudentLoan extends Loan
{
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $groupTp;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $otherStudents;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $module;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $classes;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $teacher;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $place;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $description;

    /**
     * @return mixed
     */
    public function getGroupTp()
    {
        return $this->groupTp;
    }

    /**
     * @param mixed $groupTp
     */
    public function setGroupTp($groupTp): void
    {
        $this->groupTp = $groupTp;
    }

    /**
     * @return mixed
     */
    public function getOtherStudents()
    {
        return $this->otherStudents;
    }

    /**
     * @param mixed $otherStudents
     */
    public function setOtherStudents($otherStudents): void
    {
        $this->otherStudents = $otherStudents;
    }

    /**
     * @return mixed
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param mixed $module
     */
    public function setModule($module): void
    {
        $this->module = $module;
    }

    /**
     * @return mixed
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @param mixed $classes
     */
    public function setClasses($classes): void
    {
        $this->classes = $classes;
    }

    /**
     * @return mixed
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * @param mixed $teacher
     */
    public function setTeacher($teacher): void
    {
        $this->teacher = $teacher;
    }

    /**
     * @return mixed
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param mixed $place
     */
    public function setPlace($place): void
    {
        $this->place = $place;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }
}
