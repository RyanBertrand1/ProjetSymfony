<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeacherLoanRepository")
 */
class TeacherLoan extends Loan
{
    /**
     * @ORM\Column(type="string")
     */
    private $usage;

    /**
     * @ORM\Column(type="string")
     */
    private $module;

    /**
     * @ORM\Column(type="string")
     */
    private $classes;

    /**
     * @return mixed
     */
    public function getUsage()
    {
        return $this->usage;
    }

    /**
     * @param mixed $usage
     */
    public function setUsage($usage): void
    {
        $this->usage = $usage;
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
}
