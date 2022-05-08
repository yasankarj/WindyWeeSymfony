<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Color;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $colorRed = new Color('red', 'ff0000');
        $colorGreen = new Color('green', '00ff00');
        $colorBlue = new Color('blue', '0000ff');

        $manager->persist($colorRed);
        $manager->persist($colorGreen);
        $manager->persist($colorBlue);

        $category1 = new Category();
        $category1->setName('Frocks');
        $category2 = new Category();
        $category2->setName('Pants');
        $category3 = new Category();
        $category3->setName('Kids - Boys');
        $category4 = new Category();
        $category4->setName('Kids - Girls');

        $manager->persist($category1);
        $manager->persist($category2);
        $manager->persist($category3);
        $manager->persist($category4);

        $categories = [
            'frocks' => $category1,
            'pants' => $category2,
            'kids_boys' => $category3,
            'kids_girls' => $category3,
        ];

        $brands = [
            'WindyWee',
            'ARL Fashions',
            'Lumini',
        ];

        foreach (self::getProductsData() as $productData) {
            $product = new Product();
            $product->setName($productData['name']);
            $product->setDescription($productData['description']);
            $product->setCategory($categories[$productData['category']]);
            $product->setImageFilename($productData['image']);
            $product->setPrice(rand(10, 50) * 100);
            $product->setStockQuantity(rand(10, 100));
            $product->setBrand($brands[array_rand($brands)]);

            if ($productData['with_colors'] ?? false) {
                $product->addColor($colorRed);
                $product->addColor($colorBlue);
                $product->addColor($colorGreen);
            }

            $manager->persist($product);
        }

        $fs = new Filesystem();
        $target = __DIR__.'/../../public/uploads';
        $fs->remove($target);
        $fs->mirror(__DIR__.'/uploads', $target);
        $fs->chmod($target, 0777);

        $manager->flush();
    }

    private static function getProductsData()
    {
        yield [
            'name' => 'Skirt and Blouse',
            'description' => 'Gorgeous Skirst and Blouses',
            'image' => 'skirt_and_blouse.jpg',
            'category' => 'frocks'
        ];
        yield [
            'name' => 'Ladies T Shirts',
            'description' => 'Trendy looking T Shirts for Ladies out there',
            'image' => 'tops.jpg',
            'category' => 'frocks'
        ];
        yield [
            'name' => 'Linen Pants',
            'description' => 'Linen pants for ladies for Casual or Office wear',
            'image' => 'linen_pants.jpg',
            'category' => 'pants'
        ];
        yield [
            'name' => 'Kids Checked Shorts',
            'description' => 'Smart looking checked shorts for your kid',
            'image' => 'kids_checked_shorts.jpg',
            'category' => 'kids_boys'
        ];

        yield [
            'name' => 'Kiddy Cute Frocks',
            'description' => 'Cutesy little frocks for your kids',
            'image' => 'kids_frocks.jpg',
            'category' => 'kids_girls',
            'with_colors' => true,
        ];
        yield [
            'name' => 'Kiddy Frocks - Vibrant Colors',
            'description' => 'Let your darling shines in vibrant colors.',
            'image' => 'kids_frocks_dark.jpg',
            'category' => 'kids_girls',
        ];
        yield [
            'name' => 'Kiddy Frocks for Nursery',
            'description' => 'Feel sluggish part way through the work day? Get a refresh in our official office hammock. (beach views now included).',
            'image' => 'kids_nursery_frocks.jpg',
            'category' => 'kids_girls',
            'with_colors' => true,
        ];
        yield [
            'name' => 'Kids Long Pants',
            'description' => 'Specially for winter!',
            'image' => 'kids_pants.jpg',
            'category' => 'kids_boys',
        ];
        yield [
            'name' => 'Kids T Shirts - Paper Print',
            'description' => 'Paper print art not only for adults, but also for kids.',
            'image' => 'kids_paper_print.jpg',
            'category' => 'kids_boys',
        ];

        yield [
            'name' => 'Kids - Smart T Shirts',
            'description' => 'Let your kid be the smarty pants',
            'image' => 'kids_tshirts.jpg',
            'category' => 'kids_girls',
        ];
        yield [
            'name' => 'Kids Skinnies',
            'description' => 'Skinny TOps for cute little ones',
            'image' => 'kids_skinny.jpg',
            'category' => 'kids_boys',
        ];
        yield [
            'name' => 'Kids - T Shirts',
            'description' => 'Your kid is gonna love this',
            'image' => 'kids_vcolar.jpg',
            'category' => 'kids_boys',
        ];
    }
}
