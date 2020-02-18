<?php

namespace App\DataFixtures;


use App\Entity\Books;
use App\Form\BooksType;
use App\Repository\BooksRepository;
use App\Entity\Reviews;
use App\Form\ReviewsType;
use App\Repository\ReviewsRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 books! Bam!
        for ($i = 0; $i < 5; $i++) {
            $books = new books();
            $books->setISBN($i);
            $books->setAuthor('Author '.$i);
            $books->setTitle('title'.$i);
            $books->setPrice(mt_rand(10, 100));
            $manager->persist($books);
        }

        for ($i = 0; $i < 15; $i++) {
            // var_dump($review->getBook());
            $review = new reviews();
            $review->setDescription('Hello nice book');
            $review->setName(random_bytes(10));
            $review->getBook('title'.$i);
            $manager->persist($review);
        }

        $manager->flush();
    }
}
