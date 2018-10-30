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


    /**
     * @Route("/", name="home")
     */
    public function index(SocialControl $social)
    {

        $find = $social->getSocial();
        return $this->render('home/home.html.twig', [
            'getsocial' => $find
        ]);
    }
    
    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {

    }
}
