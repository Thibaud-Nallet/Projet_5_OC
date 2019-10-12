<?php

namespace App\DataFixtures;

use App\Entity\CategoryShop;
use App\Entity\ImageShop;
use Faker\Factory;
use App\Entity\ProductShop;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductsFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR_fr');

        //Creer 3 category fake
        for ($k = 1; $k <= 3; $k++) {
            $category = new CategoryShop();
            $category->setTitle($faker->sentence());
            $manager->persist($category);

            for ($i = 1; $i < 30; $i++) {
                $product = new ProductShop();
                $title = $faker->sentence();
                $coverImage = $faker->imageUrl();
                $introduction = $faker->paragraph(2);
                $content = '<p>' . join($faker->paragraphs(5), '</p><p>') . '</p>';

                $product->setTitle($title)
                    ->setCoverImage($coverImage)
                    ->setIntroduction($introduction)
                    ->setContent($content)
                    ->setPrice(mt_rand(0, 50))
                    ->setCaption($faker->sentence())
                    ->setCategoryShop($category);;


                $manager->persist($product);

                for ($j = 1; $j <= mt_rand(2, 5); $j++) {
                    $image = new ImageShop;
                    $image->setUrl($faker->imageUrl())
                        ->setCaption($faker->sentence())
                        ->setIdProduct($product);

                    $manager->persist($image);
                }
            }
        }
        $manager->flush();
    }
}
