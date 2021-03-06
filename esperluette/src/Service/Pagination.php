<?php

namespace App\Service;

use Twig\Environment;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\RequestStack;

class Pagination
{

    private $entityClass;
    private $limit = 10;
    private $currentPage = 1;
    private $manager;
    private $twig;
    private $route;

    public function __construct(ObjectManager $manager, Environment $twig, RequestStack $request)
    {
        $this->route   = $request->getCurrentRequest()->attributes->get('_route');
        $this->manager = $manager;
        $this->twig    = $twig;
    }

    public function display()
    {
        $this->twig->display('admin/includes/pagination.html.twig', [
            'page' => $this->currentPage,
            'pages' => $this->getPages(),
            'route' => $this->route
        ]);
    }

    public function getPages()
    {
        
        if (empty($this->entityClass)) {
            throw new \Exception("Vous n'avez pas précisez l'entité sur laquelle nous devons paginer ! 
            Utilisez la méthode setEntityClass() de votre objet Pagination");
        }
        //1. Connaitre le total des enregistrements de la table 
        $repo = $this->manager->getRepository($this->entityClass);
        $total = count($repo->findAll());
        //2. Faire la division, l'arrondi et le renvoyer 
        $pages = ceil($total / $this->limit);
        return $pages;
    }

    public function getData()
    {
        //Prévient une erreur 
        if (empty($this->entityClass)) {
            throw new \Exception("Vous n'avez pas précisez l'entité sur laquelle nous devons paginer ! 
            Utilisez la méthode setEntityClass() de votre objet Pagination");
        }
        //1. Calculer l'offset
        $offset = $this->currentPage * $this->limit - $this->limit;
        //2. Demander au repo de trouver les éléments
        $repo = $this->manager->getRepository($this->entityClass);
        $data = $repo->findBy([], [], $this->limit, $offset);
        //3. Renvoyer les éléments en question
        return $data;
    }

    public function setEntityClass($entityClass)
    {
        $this->entityClass = $entityClass;
        return $this;
    }
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }
    public function getLimit()
    {
        return $this->limit;
    }

    public function setPage($page)
    {
        $this->currentPage = $page;
        return $this;
    }
    public function getPage()
    {
        return $this->currentPage;
    }

    public function setRoute($route)
    {
        $this->route = $route;
        return $this;
    }
    public function getRoute()
    {
        return $this->route;
    }
}
