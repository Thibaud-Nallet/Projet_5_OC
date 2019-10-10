<?php

namespace App\Controller;

use App\Repository\ProductShopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductShopController extends AbstractController
{
    /**
     * @Route("/admin/products", name="admin_products_index")
     */
    public function index(ProductShopRepository $repo)
    {
        return $this->render('admin/productShop/index.html.twig', [
            'products' => $repo->findAll()
        ]);
    }
}
