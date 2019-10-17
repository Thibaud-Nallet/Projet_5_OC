<?php

namespace App\Controller;

use App\Service\CartService;
use App\Repository\CategoryShopRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AjaxController extends AbstractController
{
    /**
     * Requête liée avec Ajax pour afficher le nombre de produit et le total du panier
     * @Route("/littlepanier", name="littlepanier")
     * @param CategoryShopRepository $categoryShopRepo
     * @param CartService $cartService
     * @return void
     */
    public function allPanier(CartService $cartService)
    {
        return $this->render('includes/ajax/ajaxPanier.html.twig', [
            'productTotal' => $cartService->getProductTotal(),
            'total' => $cartService->getTotal()
        ]);
    }

    /**
     * Donne le nombre total d'articles dans le panier dans la navigation 
     * @Route("/cartConnect", name="cartConnect")
     * @param CartService $cartService
     * @return void
     */
    public function cartConnect(CartService $cartService)
    {
        return $this->render('includes/ajax/ajaxCartConnect.html.twig', [
            'productTotal' => $cartService->getProductTotal()
        ]);
    }

    /**
     * Donne toutes les catégories dans la sidenav
     * @Route("/sidenav", name="sidenav")
     */
    public function sidenavCategory(CategoryShopRepository $categoryShopRepo)
    {
        return $this->render('includes/ajax/ajaxSidenav.html.twig', [
            'categories' => $categoryShopRepo->findAll(),
        ]);
    }
}
