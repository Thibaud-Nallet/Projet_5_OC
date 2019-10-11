<?php

namespace App\Controller;

use App\Entity\ImageShop;
use App\Form\ProductType;

use App\Entity\ProductShop;
use App\Repository\ProductShopRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ShopController extends AbstractController
{
    /**
     * @Route("/boutique", name="product_index")
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
     * @Route("/boutique/{slug}", name="product_show") 
     * @return Response
     */
    public function show(ProductShop $product)
    {
        return $this->render('shop/show.html.twig', [
            'product' => $product
        ]);
    }
}
