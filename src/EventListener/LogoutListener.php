<?php

namespace App\EventListener;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

 
class LogoutListener 
{
    private $em;

    public function __construct(ContainerInterface $container, EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function logout(Request $Request, Response $Response, TokenInterface $Token)
    {
        
        $route = $event->getRequest()->get('_route');
        if ($route == 'logout'){
        // Get the User entity.
        $user = $event->getAuthenticationToken()->getUser();

        // Update your field here.
        $user->setOnLineUser('false');

        // Persist the data to database.
        $this->em->persist($user);
        $this->em->flush();
    }
    }
}