<?php

namespace App\Controller;

use App\Entity\Books;
use App\Form\BooksType;
use App\Repository\BooksRepository;
use App\Entity\Reviews;
use App\Form\ReviewsType;
use App\Repository\ReviewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="Default")
     */

    public function index(booksRepository $booksRepository, ReviewsRepository $reviewsRepository)
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'Welcome',
            'books' => $booksRepository->findAll(),
            'reviews' => $reviewsRepository->findAll(),
        ]);
    }
}
