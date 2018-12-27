<?php 

namespace App\EventListener;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class LogoutListener implements LogoutHandlerInterface
{
    private $em;


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
     
    }

    public function logout(Request $Request, Response $Response, TokenInterface $Token)
    {
        $user = $Token->getUser();
        $user->setOnLineUser('0');
        $this->em->persist($user);
        $this->em->flush();

    }
}