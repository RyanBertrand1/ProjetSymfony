<?php

namespace App\DataFixtures;

use App\Entity\Loan;
use App\Entity\Material;
use App\Entity\StudentLoan;
use App\Entity\TeacherLoan;
use App\Entity\User;
use App\Security\AppCustomAuthenticator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private $formAuth;

    public function __construct(AppCustomAuthenticator $formAuth)
    {
        $this->formAuth = $formAuth;
    }

    public function load(ObjectManager $manager)
    {
        $materials = new ArrayCollection();
        $users = new ArrayCollection();

        // Material
        for($i=0; $i<11; $i++) {
            $material = new Material();
            $material->setName("materiel".$i);
            $material->setNumber("6542123".$i);
            if($i%2 === 0) {
                $material->setYear1(true);
                $material->setYear2(false);
            } else {
                $material->setYear1(false);
                $material->setYear2(true);
            }
            $material->setModel("model16515".$i);
            $material->setBuyedAt(new \DateTime());

            $materials->add($material);

            $manager->persist($material);
        }

        //User
        for($i=0; $i<11; $i++) {
            $user = new User();
            $user->setRoles(["ROLE_USER"]);
            $user->setFirstName("prenom".$i);
            $user->setLastName("nom".$i);
            $user->setMail("user".$i."@example.com");
            if($i%2 === 0) {
                $user->setType("etudiant");
            } else {
                $user->setType("enseignant");
            }
            $user->setPlainPassword("12345");
            $this->formAuth->changePassword($user);

            $users->add($user);

            $manager->persist($user);
        }

        $jobUser = new User();
        $jobUser->setRoles(["JOB_ETUDIANT"]);
        $jobUser->setFirstName("job_etudiant");
        $jobUser->setLastName("job_etudiant");
        $jobUser->setMail("job.etudiant@example.com");
        $jobUser->setPlainPassword("12345");
        $this->formAuth->changePassword($jobUser);

        $manager->persist($jobUser);

        //Loan
        for($i=0; $i<21; $i++) {

            /**
             * @var User $user
             */
            $user = $users->get(rand(0, 10));

            /**
             * @var Material $material
             */
            $material = $materials->get(rand(0,10));

            if($user->getType() === "etudiant") {
                $loan = new StudentLoan();
                $loan->setUser($user);
                $loan->addMaterial($material);
                $loan->setLeavingDate(new \DateTime());
                $loan->setReturnDate(new \DateTime());
                $loan->setStatut("En attente");
                $loan->setGroupTp("groupeTp".rand(1,2));
                $loan->setClasses("cours".rand(1,5));
                $loan->setModule("module".rand(1,5));
                $loan->setPlace("lieu".rand(1,5));
                $loan->setTeacher("enseigant".rand(1,5));
                $loan->setOtherStudents("autre étudiants...");
                $loan->setDescription("DescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescription");
            } else {
                $loan = new TeacherLoan();
                $loan->setUser($user);
                $loan->addMaterial($material);
                $loan->setLeavingDate(new \DateTime());
                $loan->setReturnDate(new \DateTime("tomorrow"));
                $loan->setStatut("En attente");
                $loan->setClasses("cours".rand(1,5));
                $loan->setModule("module".rand(1,5));
                $loan->setLoanUsage("En cours");
            }

            $manager->persist($loan);
        }
        $manager->flush();
    }
}
