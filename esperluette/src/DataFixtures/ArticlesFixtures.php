<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\ArticlesBlog;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker= Faker\Factory::create('FR_fr');

        
        for ($i = 1; $i <= 10; $i++) {
            $article = new ArticlesBlog;
            $article->setTitle("Titre de l'article n°$i")
                ->setContent("<p>Contenu de l'article n°$i</p>")
                ->setImage("http://placehold.it/350x150")
                ->setCreatedAt(new \DateTime());
            $manager->persist($article);
        }
        $manager->flush();
    }
}
