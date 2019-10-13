<?php

namespace App\Controller;

use App\Repository\CategoryShopRepository;
use App\Service\CartService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cart_index")
     * @return Response
     */
    public function panier(CartService $cartService, CategoryShopRepository $categoryShopRepo)
    {
        return $this->render('shop/cart/panier.html.twig', [
            'items' => $cartService->getFullCart(),
            'total' => $cartService->getTotal(),
            'categories' => $categoryShopRepo->findAll()
        ]);
    }

    /**
     * Ajouter un produit au panier
     * @Route("/panier/add/{id}", name="cart_add")
     */
    public function add($id, CartService $cartService)
    {
        $cartService->add($id);
        return $this->redirectToRoute('cart_index');
    }

    /**
     * Supprime un produit du panier
     * @Route("/panier/supprime/{id}", name="cart_remove")
     */
    public function remove($id, CartService $cartService)
    {
        $cartService->remove($id);
        return $this->redirectToRoute('cart_index');
    }
}
