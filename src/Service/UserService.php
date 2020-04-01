<?php


namespace App\Service;


use App\Entity\User;
use App\Security\AppCustomAuthenticator;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class UserService extends BaseService
{
    private $appAuth;

    public function __construct(EntityManagerInterface $entityManager, AppCustomAuthenticator $appAuth)
    {
        parent::__construct($entityManager);

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
}
