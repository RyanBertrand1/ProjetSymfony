<?php


namespace App\Service;


use App\Entity\User;
use App\Security\AppCustomAuthenticator;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Twig\Environment;

class UserService extends BaseService
{
    private $appAuth;

    public function __construct(EntityManagerInterface $entityManager, Environment $twig, AppCustomAuthenticator $appAuth)
    {
        parent::__construct($entityManager, $twig);

        $this->appAuth = $appAuth;
    }

    public function createAdmin(string $lastname, string $firstname, string $mail, string $plainPassword) {
        $user = new User();
        $user->setFirstName($firstname);
        $user->setLastName($lastname);
        $user->setMail($mail);
        $user->setPlainPassword($plainPassword);
        $this->appAuth->changePassword($user);

        $user->setRoles(['ROLE_ADMIN']);

        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return $user;
    }

    public function createJob() {
        $jobUser = new User();
        $jobUser->setRoles(["JOB_ETUDIANT"]);
        $jobUser->setFirstName("job_etudiant");
        $jobUser->setLastName("job_etudiant");
        $jobUser->setMail("job.etudiant@example.com");
        $jobUser->setPlainPassword("12345");
        $this->appAuth->changePassword($jobUser);

        $jobUser->setRoles(['JOB_ETUDIANT']);

        $this->getEntityManager()->persist($jobUser);
        $this->getEntityManager()->flush();

        return $jobUser;
    }
}
