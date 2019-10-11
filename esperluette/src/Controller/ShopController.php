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
     * Permet de créer un produit
     * @Route("/boutique/new", name="product_create")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $product = new ProductShop();

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
                "Le produit <strong>{$product->getTitle()}</strong>à bien été crée"
            );
            return $this->redirectToRoute('product_show', [
                'slug' => $product->getSlug()
            ]);
        }
        return $this->render('shop/new.html.twig', [
            'productForm' => $form->createView()
        ]);
    }


    /**
     * Permet de supprimer un produit 
     * @Route("/boutique/{slug}/delete", name="product_delete")
     * @IsGranted("ROLE_ADMIN")
     * @param ProductShop $product
     * @param ObjectManager $manager
     * @return void
     */
    public function delete(ProductShop $product, ObjectManager $manager) {
        $manager->remove($product);
        $manager->flush();
        $this->addFlash(
            'success',
            "Le produit <strong>{$product->getTitle()}</strong> à bien été supprimé"
        );
        return $this->redirectToRoute("product_index");
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
