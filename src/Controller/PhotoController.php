<?php

namespace App\Controller;

use App\Entity\Galerie;
use App\Form\GalerieFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PhotoController extends Controller
{


    public function __construct(EntityManagerInterface $entityManager)
    {
    $this->entityManager = $entityManager;
    $this->GalerieRepository = $entityManager->getRepository('App:Galerie');
    $this->userRepository = $entityManager->getRepository('App:User');
    }


    /**
     * @Route("/photo", name="photo")
     */
    public function index()
    {
        $images = $this->getDoctrine()
        ->getRepository(Galerie::class)
        ->findAll();
        return $this->render('photo/galerie.html.twig', [
            'images' => $images,
        ]);
    }

    /**
     * @Route("/edit_Galerie", name="editGalerie")
     */
    public function editGalerie()
    {
        $images = $this->getDoctrine()
        ->getRepository(Galerie::class)
        ->findAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $images
        );
        return $this->render('photo/edit_galerie.html.twig', [
            'images' => $images, 'pagination' => $pagination
        ]);
    }


    /**
 * @Route("/delete-image", name="deleteImage", options={"expose"=true})
 *
 * @param $entryId
 *
 * @return \Symfony\Component\HttpFoundation\RedirectResponse
 */
public function deleteImage(Request $request)
{
    if($request->isXmlHttpRequest()){
    $entryId = $request->request->get('id');
    $image = $this->GalerieRepository->findOneById($entryId);
    $author = $this->userRepository->findOneByUsername($this->getUser()->getUserName());

    if (!$image || $author !== $image->getUserGalerie()) {
        $this->addFlash('error', "Impossible de supprimer l\'enregistrement");

        return $this->redirectToRoute('editGalerie');
    }

    $this->entityManager->remove($image);
    $this->entityManager->flush();


    return new Response('Post delete');
}
return new Response("Erreur : ce n'est pas une requete Ajax", 400);
}

    /**
     * @Route("/add_image", name="galerieCreate")
     */
    public function addImage(Request $request)
    {
        $image = new Galerie();
    

    $author = $this->userRepository->findOneByUsername($this->getUser()->getUserName());
    $image->setUserGalerie($author);

    $form = $this->createForm(GalerieFormType::class, $image);
    $form->handleRequest($request);

    // Check is valid
    if ($form->isSubmitted() && $form->isValid()) {
        $this->entityManager->persist($image);
        $this->entityManager->flush($image);

        $this->addFlash('success', 'Votre image à bien été enregistée');

        return $this->redirectToRoute('editGalerie');
    }
        return $this->render('photo/create_galerie.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
