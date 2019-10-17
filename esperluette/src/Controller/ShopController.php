<?php

namespace App\Controller;


use App\Entity\ProductShop;
use App\Service\Pagination;
use App\Entity\CategoryShop;
use App\Service\CartService;
use App\Repository\ProductShopRepository;
use App\Repository\CategoryShopRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShopController extends AbstractController
{
    /**
     * @Route("/boutique/{page<\d+>?1}", name="product_index")
     */
    public function shop(ProductShopRepository $productShopRepo, Pagination $pagination, $page)
    {
        $pagination->setEntityClass(ProductShop::class)
            ->setPage($page)
            ->setLimit(24);

        return $this->render('shop/shop.html.twig', [
            'products' => $productShopRepo->findAll(),
            'pagination' => $pagination
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
            'product' => $product, 
        ]);
    }

    /**
     * Permet d'afficher les produit de la catégorie
     * @Route("/boutique/categorie/{id}", name="product_show_category")
     */
    public function showCategory(ProductShopRepository $productRepo, CategoryShopRepository $categoryShopRepo, $id)
    {
        $product = $productRepo->findBy([
            'categoryShop' => $id
        ]);
 
        return $this->render('shop/showCategory.html.twig', [
            'productCategory' => $product,
            'category' => $categoryShopRepo->find($id),
        ]);
    }
}
