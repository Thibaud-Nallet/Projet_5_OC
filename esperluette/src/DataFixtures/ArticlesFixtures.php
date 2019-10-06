<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\ArticlesBlog;
use App\Entity\CategoryBlog;
use App\Entity\CommentBlog;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker= \Faker\Factory::create('fr_FR');

        //Creer 3 category fake
        for ($i=1; $i<=3; $i++) {
            $category = new CategoryBlog();
            $category->setTitle($faker->sentence())
                      ->setDescription($faker->paragraph());
            $manager->persist($category);

            //Creer entre 4 et 6 articles par category
            for ($j = 1; $j <= mt_rand(4, 6); $j++) {
                $article = new ArticlesBlog;
                $content = '<p>' . join($faker->paragraphs(5), '</p><p>') . '</p>';

                $article->setTitle($faker->sentence())
                    ->setContent($content)
                    ->setImage($faker->imageUrl())
                    ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                    ->setCategoryBlog($category);
                $manager->persist($article);

                //Creer entre 4 et 10 comments par article
                for ($k = 1; $k <= mt_rand(4, 6); $k++) {
                    $comments = new CommentBlog;
                    $content = '<p>' . join($faker->paragraphs(2), '</p><p>') . '</p>';
                    $days = (new \DateTime())->diff($article->getCreatedAt())->days;

                    $comments->setAuthor($faker->name())
                        ->setContent($content)
                        ->setCreatedAt($faker->dateTimeBetween('-' . $days . 'days'))
                        ->setIdArticle($article);

                    $manager->persist($comments);
                }
            }
        }
        $manager->flush();
    }
}
