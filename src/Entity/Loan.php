<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LoanRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="entity_type", type="string")
 * @ORM\DiscriminatorMap({"studentLoan" = "StudentLoan", "teacherLoan" = "TeacherLoan"})
 *
 * @ORM\HasLifecycleCallbacks()
 */
abstract class Loan
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    * @ORM\Column(type="datetime")
    */
    protected $leavingDate;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $returnDate;

    /**
     * @ORM\Column(type="string")
     */
    protected $statut;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="loans", cascade={"persist"})
     */
    protected $user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Material", inversedBy="loans")
     */
    protected $materials;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $specificDemand;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    public function __construct()
    {
        $this->materials = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLeavingDate()
    {
        return $this->leavingDate;
    }

    /**
     * @param mixed $leavingDate
     */
    public function setLeavingDate($leavingDate): void
    {
        $this->leavingDate = $leavingDate;
    }

    /**
     * @return mixed
     */
    public function getReturnDate()
    {
        return $this->returnDate;
    }

    /**
     * @param mixed $returnDate
     */
    public function setReturnDate($returnDate): void
    {
        $this->returnDate = $returnDate;
    }

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param mixed $statut
     */
    public function setStatut($statut): void
    {
        $this->statut = $statut;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getMaterials()
    {
        return $this->materials;
    }

    /**
     * @param mixed $materials
     */
    public function setMaterials($materials): void
    {
        $this->materials = $materials;
    }

    public function addMaterial(Material $material) {
        $this->materials->add($material);
        $material->addLoan($this);
    }

    /**
     * @return mixed
     */
    public function getSpecificDemand()
    {
        return $this->specificDemand;
    }

    /**
     * @param mixed $specificDemand
     */
    public function setSpecificDemand($specificDemand): void
    {
        $this->specificDemand = $specificDemand;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist()
     */
    public function onPrePersist() {
        $this->createdAt = new \DateTime();
    }
}
