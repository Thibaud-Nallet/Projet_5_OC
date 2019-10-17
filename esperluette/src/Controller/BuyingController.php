<?php

namespace App\Controller;

use App\Entity\Adress;
use App\Form\AdressType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BuyingController extends AbstractController
{
    /**
     * @Route("/panier/livraison", name="livraison")
     * @IsGranted("ROLE_USER")
     */
    public function livraison(Request $request, ObjectManager $manager)
    {
        $adress = new Adress();
        $form = $this->createForm(AdressType::class, $adress);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($adress);
            $manager->flush();
            return $this->redirectToRoute('recap');
        }
    
        return $this->render('achat/livraison/livraison.html.twig', [
            'formAdress' => $form->createView()
        ]);
    }

    /**
     * Recap avant paiement
     * @Route("/panier/recap", name="recap")
     * @IsGranted("ROLE_USER")
     */
    public function recap() {
        return $this->render('achat/recap/recap.html.twig');
    }
}
