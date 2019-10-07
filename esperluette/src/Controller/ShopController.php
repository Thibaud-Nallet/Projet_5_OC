<?php

namespace App\Controller;

use App\Entity\ProductShop;
use App\Repository\ProductShopRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ShopController extends AbstractController
{
    /**
     * @Route("/shop", name="product_index")
     */
    public function shop(ProductShopRepository $repo)
    {
        $products = $repo->findAll();
        return $this->render('shop/shop.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * Permet d'afficher un produit
     * @Route("/shop/{slug}", name="product_show") 
     * @return Response
     */ 
    public function show(ProductShop $product)
    {
        return $this->render('shop/show.html.twig', [
            'product' => $product
        ]);
    }
}
