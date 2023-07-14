<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\UserFactory;
use App\Factory\PostFactory;
use App\Factory\CommentFactory;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        UserFactory::createOne(['email' => 'admin_1@example.com', 'roles'=>['ROLE_ADMIN']]);
        UserFactory::createMany(10);

        $posts = PostFactory::createMany(50, function() {
            return [
                'author' => UserFactory::random(),
            ];
        });
        $comments=CommentFactory::createMany(200, function() {
            return [
                'post'=>PostFactory::random(),
                'author' => UserFactory::random(),
            ];
        });
        UserFactory::createOne(['email' => 'user_1@example.com']);
        $manager->flush();
    }
}
