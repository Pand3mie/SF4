<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;




class AdminController extends Controller
{

    public function __construct(EntityManagerInterface $entityManager)
    {
    $this->entityManager = $entityManager;
    $this->blogPostRepository = $entityManager->getRepository('App:BlogPost');
    $this->userRepository = $entityManager->getRepository('App:User');
    }


    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

 /**
 * 
 * @Route("/entries", name="admin_entries")
 *
 * @return \Symfony\Component\HttpFoundation\Response
 */
public function entriesAction(Request $request)
{
  
//    $author = $this->userRepository->findOneByUsername($this->getUser()->getUserName());

 //   $blogPosts = [];

  //  if ($author) {
   //     $blogPosts = $this->blogPostRepository->findByAuthor($author);
  //  }
     $blogPosts = $this->blogPostRepository->findBy(array(),array('id' => 'DESC'));
     $paginator  = $this->get('knp_paginator');
     $pagination = $paginator->paginate($blogPosts, $request->query->getInt('page', 1), 3);
    return $this->render('default/admin/entries.html.twig', [
        'blogPosts' => $blogPosts, 'pagination' => $pagination
    ]);
}

/**
 * @Route("/delete-entry", name="admin_delete_entry", options={"expose"=true})
 *
 * @param $entryId
 *
 * @return \Symfony\Component\HttpFoundation\RedirectResponse
 */
public function deleteEntryAction(Request $request)
{
    if($request->isXmlHttpRequest()){
    $entryId = $request->request->get('id');
    $blogPost = $this->blogPostRepository->findOneById($entryId);
    $author = $this->userRepository->findOneByUsername($this->getUser()->getUserName());

    if (!$blogPost || $author !== $blogPost->getAuthor()) {
        $this->addFlash('error', "Impossible de supprimer l\'enregistrement");

        return $this->redirectToRoute('admin_entries');
    }

    $this->entityManager->remove($blogPost);
    $this->entityManager->flush();


    return new Response('Post delete');
}
return new Response("Erreur : ce n'est pas une requete Ajax", 400);
}

}
