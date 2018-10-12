<?php 

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\User;

class LogoutListener implements LogoutHandlerInterface
{
protected $securityContext;
protected $em;

public function __construct(TokenStorage $securityContext, EntityManagerInterface $em)
{
    $this->securityContext = $securityContext;
    $this->em = $em;
}

public function logout(Request $Request, Response $Response, TokenInterface $Token)
{
    $user = $this->securityContext->getToken()->getUser();
    $user->setOnLineUser('false');
    $this->em->persist($user);
    $this->em->flush();

}
}