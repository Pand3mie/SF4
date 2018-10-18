<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
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
public function entriesAction()
{
    $author = $this->userRepository->findOneByUsername($this->getUser()->getUserName());

    $blogPosts = [];

    if ($author) {
        $blogPosts = $this->blogPostRepository->findByAuthor($author);
    }

    return $this->render('default/admin/entries.html.twig', [
        'blogPosts' => $blogPosts
    ]);
}

/**
 * @Route("/delete-entry/{entryId}", name="admin_delete_entry")
 *
 * @param $entryId
 *
 * @return \Symfony\Component\HttpFoundation\RedirectResponse
 */
public function deleteEntryAction($entryId)
{
    $blogPost = $this->blogPostRepository->findOneById($entryId);
    $author = $this->userRepository->findOneByUsername($this->getUser()->getUserName());

    if (!$blogPost || $author !== $blogPost->getAuthor()) {
        $this->addFlash('error', 'Unable to remove entry!');

        return $this->redirectToRoute('admin_entries');
    }

    $this->entityManager->remove($blogPost);
    $this->entityManager->flush();

    $this->addFlash('success', 'Entry was deleted!');

    return $this->redirectToRoute('admin_entries');
}


}
