<?php

namespace App\Controller;


use App\Entity\ProductShop;
use App\Service\CartService;
use App\Repository\ProductShopRepository;
use App\Repository\CategoryShopRepository;
use App\Service\Pagination;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShopController extends AbstractController
{
    /**
     * @Route("/boutique/{page<\d+>?1}", name="product_index")
     */
    public function shop(ProductShopRepository $productShopRepo, CategoryShopRepository $categoryShopRepo, CartService $cartService, Pagination $pagination, $page)
    {
        $pagination->setEntityClass(ProductShop::class)
            ->setPage($page)
            ->setLimit(9);

        return $this->render('shop/shop.html.twig', [
            'products' => $productShopRepo->findAll(),
            'categories' => $categoryShopRepo->findAll(),
            'productTotal' => $cartService->getProductTotal(),
            'total' => $cartService->getTotal(),
            'pagination' => $pagination
        ]);
    }

    /**
     * Permet d'afficher un produit
     * @Route("/boutique/{slug}", name="product_show") 
     * @return Response
     */
    public function show(ProductShop $product, CategoryShopRepository $categoryShopRepo, CartService $cartService)
    {
        return $this->render('shop/show.html.twig', [
            'product' => $product,
            'categories' => $categoryShopRepo->findAll(),
            'productTotal' => $cartService->getProductTotal(),
            'total' => $cartService->getTotal()
        ]);
    }
}
