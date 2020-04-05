<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MaterialRepository")
 *
 * @ORM\HasLifecycleCallbacks()
 */
class Material
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $buyedAt;

    /**
     * @ORM\Column(type="string")
     */
    private $model;

    /**
     * @ORM\Column(type="string")
     */
    private $number;

    /**
     * @ORM\Column(type="boolean")
     */
    private $year1;

    /**
     * @ORM\Column(type="boolean")
     */
    private $year2;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Loan", mappedBy="materials")
     */
    private $loans;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $abime;

    /**
     * @ORM\Column(type="text")
     */
    private $note;

    public function __construct()
    {
        $this->loans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getBuyedAt()
    {
        return $this->buyedAt;
    }

    /**
     * @param mixed $buyedAt
     */
    public function setBuyedAt($buyedAt): void
    {
        $this->buyedAt = $buyedAt;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number): void
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getYear1()
    {
        return $this->year1;
    }

    /**
     * @param mixed $year1
     */
    public function setYear1($year1): void
    {
        $this->year1 = $year1;
    }

    /**
     * @return mixed
     */
    public function getYear2()
    {
        return $this->year2;
    }

    /**
     * @param mixed $year2
     */
    public function setYear2($year2): void
    {
        $this->year2 = $year2;
    }

    /**
     * @return mixed
     */
    public function getLoans()
    {
        return $this->loans;
    }

    /**
     * @param mixed $loans
     */
    public function setLoans($loans): void
    {
        $this->loans = $loans;
    }

    public function addLoan(Loan $loan) {
        $this->loans->add($loan);
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getAbime()
    {
        return $this->abime;
    }

    /**
     * @param mixed $abime
     */
    public function setAbime($abime): void
    {
        $this->abime = $abime;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note): void
    {
        $this->note = $note;
    }

    /**
     * @ORM\PrePersist()
     */
    public function onPrePersist(){
        $this->createdAt = new \DateTime();
    }
}
