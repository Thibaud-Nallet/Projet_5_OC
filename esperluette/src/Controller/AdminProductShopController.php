<?php

namespace App\Controller;

use App\Form\ProductType;
use App\Entity\ProductShop;
use App\Repository\ProductShopRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


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

    /**
     * Edite un produit
     * @Route("/admin/products/{id}/edit", name="admin_products_edit")
     * @IsGranted("ROLE_ADMIN")
     * @param ProductShop $product
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function show(ProductShop $product, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //Prend en compte les images de l'autre entity
            foreach ($product->getImagesShop() as $imagesShop) {
                $imagesShop->setIdProduct($product);
                $manager->persist($imagesShop);
            }
            $manager->persist($product);
            $manager->flush();
            $this->addFlash(
                'success',
                "Le produit <strong>{$product->getTitle()}</strong>à bien été modifié"
            );
        }
        return $this->render('admin/productShop/edit.html.twig', [
            'product' => $product,
            'productForm' => $form->createView(),
        ]);
    }

}
