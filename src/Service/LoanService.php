<?php


namespace App\Service;


use App\Entity\Loan;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Environment;

class LoanService extends BaseService
{
    private $mailer;

    public function __construct(EntityManagerInterface $entityManager, Environment $twig ,\Swift_Mailer $mailer)
    {
        parent::__construct($entityManager, $twig);

        $this->mailer = $mailer;
    }

    public function refuser(Loan $loan, string $raison) {
        $loan->setStatut('Refusée');

        $message = (new \Swift_Message('Refus de demande de prêt'))
            ->setFrom('symfony.mailsender@gmail.com')
            ->setTo($loan->getUser()->getMail())
            ->setBody(
                $this->twig->render('mail/mail_refus.html.twig', [
                    'loan' => $loan,
                    'raison' => $raison
                ]),
                'text/html'
            )
        ;

        $this->mailer->send($message);

        $this->getEntityManager()->persist($loan);
        $this->getEntityManager()->flush();
    }

    public function traiter(Loan $loan){
        $loan ->setStatut('À finaliser');

        $message = (new \Swift_Message('Demande de prêt traitée'))
            ->setFrom('symfony.mailsender@gmail.com')
            ->setTo($loan->getUser()->getMail())
            ->setBody(
                $this->twig->render('mail/mail_traitee.html.twig', [
                    'loan' => $loan,
                ]),
                'text/html'
            )
        ;

        $this->mailer->send($message);

        $this->getEntityManager()->persist($loan);
        $this->getEntityManager()->flush();
    }
}