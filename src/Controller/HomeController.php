<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Service\SocialControl;
use App\Repository\BlogPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    public function __construct(EntityManagerInterface $entityManager)
    {
    $this->entityManager = $entityManager;
    $this->blogPostRepository = $entityManager->getRepository('App:BlogPost');
    $this->userRepository = $entityManager->getRepository('App:User');
    $this->tagRepository = $entityManager->getRepository('App:Tag');
    }

    /**
     * @Route("/", name="home")
     */
    public function index(SocialControl $social)
    {
        $query = $this->blogPostRepository->getLastBlogPost();

        $find = $social->getSocial();
        return $this->render('home/home.html.twig', [
            'getsocial' => $find, 'last' => $query
        ]);
    }
    
    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {

    }
}
