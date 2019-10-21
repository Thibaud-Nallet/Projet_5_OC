<?php

namespace App\Controller;

use App\Entity\Adress;
use App\Form\AdressUserType;
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
        $adressUser = $this->getUser();
        $form = $this->createForm(AdressUserType::class, $adressUser);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($adressUser);
            $manager->flush();
            return $this->redirectToRoute('recap');
        }
    
        return $this->render('achat/livraison/livraison.html.twig', [
            'form' => $form->createView()
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
