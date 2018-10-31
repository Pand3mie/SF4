<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Form\CommentType;
use App\Entity\BlogComment;
use App\Form\EntryFormType;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends Controller

{

    private $entityManager;

    private $authorRepository;
    private $blogPostRepository;


    public function __construct(EntityManagerInterface $entityManager)
    {
    $this->entityManager = $entityManager;
    $this->blogPostRepository = $entityManager->getRepository('App:BlogPost');
    $this->userRepository = $entityManager->getRepository('App:User');
    $this->tagRepository = $entityManager->getRepository('App:Tag');
    }


    /**
     * @Route("/blog", name="blog")
     */
    public function index(Request $request)
    {
        $query = $this->blogPostRepository->getTagsMeta();
        //dump($query);

        //$query = $this->blogPostRepository->findBy(array(),array('id' => 'DESC'));

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 2)
        );
        return $this->render('blog/blog.html.twig', [
            'blogPosts' => $query, 'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/blog/view/{id}", name="blog_view")
     */
    public function blogDetails(Request $request, EntityManagerInterface $em, $id)
    {



        $article = $this->getDoctrine()
        ->getRepository(BlogPost::class)
        ->find($id);

      if (!$article) {
        throw $this->createNotFoundException(
            'No product found for id '.$id
        );
    }

    $comments = $this->getDoctrine()
    ->getRepository(BlogComment::class)
    ->findBy(array('comment_post' => $id));

    $comment = new BlogComment();
    $author = $this->userRepository->findOneByUsername($this->getUser()->getUserName());
    $comment->setAuthor($author);
    $comment->setCommentPost($article);
    $form = $this->createForm(CommentType::class, $comment);
    
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){

        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        return $this->redirectToRoute('blog_view', ['id' => $id]);
    }
        return $this->render('blog/details.html.twig', [
            'blogPosts' => $article, 'form' => $form->createView(), 'comments' => $comments
        ]);
    }


    /**
 * @Route("/create-entry", name="admin_create_entry")
 *
 * @param Request $request
 *
 * @return \Symfony\Component\HttpFoundation\Response
 */
public function createEntryAction(Request $request)
{
    $blogPost = new BlogPost();
    

    $author = $this->userRepository->findOneByUsername($this->getUser()->getUserName());
    $blogPost->setAuthor($author);

    $form = $this->createForm(EntryFormType::class, $blogPost);
    $form->handleRequest($request);

    // Check is valid
    if ($form->isSubmitted() && $form->isValid()) {
        $this->entityManager->persist($blogPost);
        $this->entityManager->flush($blogPost);

        $this->addFlash('success', 'Votre post à bien été créé');

        return $this->redirectToRoute('admin_entries');
    }

    return $this->render('default/admin/entry_form.html.twig', [
        'form' => $form->createView()
    ]);
}
}
