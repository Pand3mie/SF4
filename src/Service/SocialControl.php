<?php 

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class SocialControl
{

    protected $securityContext;
    protected $em;
    
    public function __construct(TokenStorageInterface $securityContext, EntityManagerInterface $em)
    {
        $this->securityContext = $securityContext;
        $this->em = $em;
    }

    public function getSocial()
    {
        $id = $this->securityContext->getToken()->getUser()->getId();
        return $this->em->getRepository('App:User')->find($id);

    }

}