<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;

class StatService
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function getCount()
    {
        $users    = $this->getUsersCount();
        $products = $this->getProductsCount();
        $articles = $this->getArticlesCount();
        $comments = $this->getCommentsCount();

        return compact('users', 'products', 'articles', 'comments');
    }

    public function getUsersCount()
    {
        return $this->manager->createQuery('SELECT COUNT(u) FROM App\Entity\User u')->getSingleScalarResult();
    }

    public function getProductsCount()
    {
        return $this->manager->createQuery('SELECT COUNT(p) FROM App\Entity\ProductShop p')->getSingleScalarResult();
    }

    public function getCommentsCount()
    {
        return $this->manager->createQuery('SELECT COUNT(c) FROM App\Entity\CommentBlog c')->getSingleScalarResult();
    }

    public function getArticlesCount()
    {
        return $this->manager->createQuery('SELECT COUNT(a) FROM App\Entity\ArticlesBlog a')->getSingleScalarResult();
    }

    public function getLastProducts()
    { 
    return $this->manager->createQuery(
            'SELECT p
            FROM App\Entity\ProductShop p
            ORDER BY p.id DESC'
        )->setMaxResults(5)
        ->getResult();
    }
}
