<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\SocialControl;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(SocialControl $social)
    {
        $find = $social->getSocial();
        return $this->render('home/home.html.twig', [
            'getsocial' => $find,
        ]);
    }
    
    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {

    }
}
