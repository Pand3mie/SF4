<?php

namespace App\Controller;

use App\Entity\Galerie;
use App\Entity\Avis;
use App\Form\GalerieFormType;
use App\Form\AvisResponseType;
use App\Form\AvisType;
use App\Repository\GalerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;


class PhotoController extends Controller
{

    private $galerieRepository;
    private $avisRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
    $this->entityManager = $entityManager;
    $this->GalerieRepository = $entityManager->getRepository('App:Galerie');
    $this->userRepository = $entityManager->getRepository('App:User');
    $this->avisRepository = $entityManager->getRepository('App:Avis');
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
     * @Route("/view_image/{id}", name="viewImage")
     */
    public function viewImage($id)
    {
       
        $images = $this->getDoctrine()
        ->getRepository(Galerie::class)
        ->find($id);
        dump($images);
        return $this->render('photo/view_image.html.twig', [
            'images' => $images,
        ]);
    }

    /**
     * @Route("/download/{id}", name="download")
     */
    public function downloadImage($id, Request $request)
    {   
        
            $id = $request->attributes->get('id');
            //dump($id);
            $image = $this->GalerieRepository->findOneById($id);
            $filename = $image->getImage();
            $author = $this->userRepository->findOneByUsername($this->getUser()->getUserName());
            $download_image = $this->getParameter('download').'\\'.$filename;
            return $this->file($download_image);
        }

        
    /**
     * @Route("/edit_Galerie", name="editGalerie")
     */
    public function editGalerie()
    {

        $images = $this->getDoctrine()
        ->getRepository(Galerie::class)
        ->findAll();
        $query = $this->avisRepository->getAvisImage();
        dump($query);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $images
        );

        return $this->render('photo/edit_galerie.html.twig', ['avis' => $query,
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
        $file = $image->getImage();
        $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
        try {
            $file->move(
                $this->getParameter('image'),
                $fileName
            );
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }
        $image->setImage($fileName);

        $this->entityManager->persist($image);
        $this->entityManager->flush($image);

        $this->addFlash('success', 'Votre image à bien été enregistée');

        return $this->redirectToRoute('editGalerie');
    }
        return $this->render('photo/create_galerie.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

    /**
     * @Route("/star", name="star-save", options={"expose"=true})
     */
    public function starSave(Request $request)
    {
        if($request->isXmlHttpRequest()){
            $id = $request->request->get('id');
            $star = $request->request->get('ratingValue');
            $image = $this->GalerieRepository->findOneById($id);
            $image->setStar($star);
            $this->entityManager->persist($image);
            $this->entityManager->flush();
        
        
            return new Response('Post delete');
        }
        return new Response("Erreur : ce n'est pas une requete Ajax", 400);
    }

    
    /**
     * @Route("/avis/{id}", name="avis", options={"expose"=true})
     */
    public function avis($id, Request $request)
    {

        //get image with id
        $image = $this->getDoctrine()
        ->getRepository(Galerie::class)
        ->find($id);
        
        //find user of image
       // $author = $this->userRepository->findOneByUsername($this->getUser()->getUserName());
       // $image->setUserGalerie($author);

        // form Avis
        $avis = new Avis();
        $galerie = new Galerie();
        $avis->setAvis_image($image->addAvis($avis));
       

        $form = $this->createForm(AvisType::class, $avis);

        //getAuthor
        $author = $this->userRepository->findOneByUsername($this->getUser()->getUserName());

        $avis->setAuthor($author);
   

        $form->handleRequest($request);


       // dump($p);

       // Check is valid
       if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($avis);
            $this->entityManager->flush($avis);

            $this->addFlash('success', 'Votre avis à bien été pris en compte');
   
           return $this->redirectToRoute('photo');
    
        }
        return $this->render('photo/avis.html.twig', ['image'=>$image->getId(),
        'preview'=>$image,
        'form' => $form->createView(), 'author' => $author         
        ]);
    }

    /**
     * @Route("/consulte-avis/{id}", name="consulte-avis", options={"expose"=true})
     */
    public function consulteAvis($id, Request $request)
    {
        $form = $this->createForm(AvisResponseType::class);
        $form->handleRequest($request);

        $id = $request->attributes->get('id');
        dump($id);
        $avis = $this->avisRepository->getAllAvisImage($id);
        dump($avis);
        return $this->render('photo/consulte-avis.html.twig', ['avis'=>$avis,
        'id' => $id,'form' => $form->createView(),
        ]);

    }

}
