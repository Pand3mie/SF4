<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\BlogPost;
use App\Form\EntryFormType;

class BlogController extends AbstractController

{

    private $entityManager;

    private $authorRepository;
    private $blogPostRepository;


    public function __construct(EntityManagerInterface $entityManager)
    {
    $this->entityManager = $entityManager;
    $this->blogPostRepository = $entityManager->getRepository('App:BlogPost');
    $this->userRepository = $entityManager->getRepository('App:User');
    }


    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        return $this->render('blog/blog.html.twig', [
            'blogPosts' => $this->blogPostRepository->findAll()
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
    $blogPost->setUser($author);

    $form = $this->createForm(EntryFormType::class, $blogPost);
    $form->handleRequest($request);

    // Check is valid
    if ($form->isSubmitted() && $form->isValid()) {
        $this->entityManager->persist($blogPost);
        $this->entityManager->flush($blogPost);

        $this->addFlash('success', 'Congratulations! Your post is created');

        return $this->redirectToRoute('admin_entries');
    }

    return $this->render('default/admin/entry_form.html.twig', [
        'form' => $form->createView()
    ]);
}
}
