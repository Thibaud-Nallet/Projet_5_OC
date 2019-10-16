<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BuyingController extends AbstractController
{
    /**
     * @Route("/panier/livraison", name="livraison")
     * //@IsGranted("ROLE_USER")
     */
    public function livraison()
    {
        return $this->render('achat/livraison/livraison.html.twig', [
            'controller_name' => 'BuyingController',
        ]);
    }
}
