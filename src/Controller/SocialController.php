<?php

namespace App\Controller;

use App\Entity\Social;
use App\Form\SocialType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class SocialController extends AbstractController
{

    /**
     * @Route("/addSocial", name="addsocial")
     * 
     */
    public function addSocial(Request $request)
    {
        $social = new Social();
        $form = $this->createForm(SocialType::class, $social);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($social);
            $em->flush();

            return $this->redirectToRoute('home');
        }
        return $this->render('social/addSocial.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
