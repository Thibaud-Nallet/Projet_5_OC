<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Adress;
use App\Form\AdressUserType;
use App\Service\CartService;
use App\Repository\UserRepository;
use App\Repository\ProductShopRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
    public function recap(UserRepository $user, CartService $cartService) {
        $user = $this->getUser();
        
        return $this->render('achat/recap/recap.html.twig', [
            'user' => $user,
            'items' => $cartService->getFullCart(),
            'total' => $cartService->getTotal(),
            'port' => $cartService->getPort()
        ]);
    }

    /**
     * Met le panier dans la base de données
     * @Route("/panier/enregistrement", name="panier_bdd")
     * @return void
     */
    public function cartDB(CartService $cartService)
    {
        //Recupère les données de l'utilisateur : nom, prénom, adresse de livraison
        $user = $this->getUser();
        //Recupère le panier de la session
        $commande = $cartService->getFullCart();
        
        dd($commande);
        return $this->redirectToRoute('home');
    }

    public function prepareCommande()
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        if(!$session->has('commande')) {
            $commande = new Commande();
        } else {
            $commande = $em->getRepository('EcommerceBundles:Commandes')->find($session->get('commande'));
        }
        $commande = $this->getUser();
        $commande->setValider(0)
        ->setReference(0)
        ->setProduits($this->facture());
        //if(!$session->has('commande')) {
            //$em->persist($commande);
        //} 
        //$em->flush();
        //return
    }

    public function facture()
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        $generator = $this->container->get('security.secure_random');
        $adresse = $session->get('adress');
        $panier = $session->get('panier');
        $commande = array();
        $total = 0;
        $facturation = $em->getRepository('EcommerceBundles:UtilisateursAdress')->find($adresse[facturation]);
        $produit = $em->getRepository('EcommerceBundles:Produit')->findArray(array_keys($session->get('panier')));
    }

}

