<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Psr\Log\LoggerInterface;
use App\Service\SocialControl;
use Symfony\Component\Debug\Debug;
use App\Repository\BlogPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
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


        $usersOnline = $this->userRepository->findAll();

        $query = $this->blogPostRepository->getLastBlogPost();

        $find = $social->getSocial();
        return $this->render('home/home.html.twig', [
            'getsocial' => $find, 'last' => $query, 'userOnline' => $usersOnline
        ]);
       
    }

    /**
     * @Route("/connect", name="connect" , options={"expose"=true})
     */
    public function connect(Request $request){

         
        if($request->isXmlHttpRequest()){
            $usersOnline = $this->userRepository->findAll();
            return $this->render('home/connect.html.twig', [
                'userOnline' => $usersOnline
            ]);
        }
        return new Response("Erreur : ce n'est pas une requete Ajax", 400);
        
    }

    
    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {

    }
}
