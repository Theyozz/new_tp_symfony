<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    const NB_PRODUCTS = 30;
    const NB_CATEGORIES = 5;

    public function load(ObjectManager $manager): void
{
    $faker = Factory::create();
    $categories = [];

    for ($i=0; $i < self::NB_CATEGORIES; $i++) { 
        $category = new Category();
        $category
            ->setName($faker->word(10));

        $categories[] = $category;
        $manager->persist($category);
    }

    $manager->flush();

    for ($i=0; $i < self::NB_PRODUCTS; $i++) { 
        $product = new Product();
        $product
            ->setName($faker->word(10))
            ->setDescription($faker->text(70))
            ->setPriceTaxesFree($faker->randomFloat(2,20,200))
            ->setVisible($faker->boolean(60))
            ->setDiscount($faker->boolean(30))
            ->setCategoryId($categories[array_rand($categories)]);
        $manager->persist($product);
    }
    
    $manager->flush();
}
}
