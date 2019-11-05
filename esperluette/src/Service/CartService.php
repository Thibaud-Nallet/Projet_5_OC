<?php

namespace App\Service;

use App\Repository\ProductShopRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    protected $session;
    protected $productShopRepo;
    private $manager;

    public function __construct(SessionInterface $session, ProductShopRepository $productShopRepo, ObjectManager $manager)
    {
        $this->session = $session;
        $this->productShopRepo = $productShopRepo;
        $this->manager = $manager;
    }

    public function add(int $id)
    {
        $panier = $this->session->get('panier', []);
        $panier[$id] = 1;
        $this->session->set('panier', $panier);
    }

    public function remove(int $id)
    {
        $panier = $this->session->get('panier', []);
        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }
        $this->session->set('panier', $panier);
    }

    public function getFullCart(): array
    {
        $panier = $this->session->get('panier', []);
        $panierWithData = [];
        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'product' => $this->productShopRepo->find($id),
                //'quantity' => $quantity,  
            ];
        }
        return $panierWithData;
    }

    public function getFulLCartBDD(): array
    {
        $panier = $this->session->get('panier', []);
        foreach ($panier as $id) {
            $commande = [
                'product' => $this->productShopRepo->find($id)
            ];
        }
        return $commande;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->getFullCart() as $item) {
            $total += $item['product']->getPrice() /* * $item['quantity']*/;
        }
        return $total;
    }

    public function getProductTotal()
    {
        $productTotal = count($this->getFullCart());
        return $productTotal;
    }

    public function getPort()
    {
        $port = 0;
        foreach ($this->getFullCart() as $item) {
            $port += $item['product']->getFraisLivraison() /* * $item['quantity']*/;
            
        }
        return $port;
    }


}
