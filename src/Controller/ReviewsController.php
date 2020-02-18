<?php

namespace App\Controller;

use App\Entity\Reviews;
use App\Form\ReviewsType;
use App\Repository\ReviewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reviews")
 */
class ReviewsController extends AbstractController
{
    /**
     * @Route("/", name="reviews_index", methods={"GET"})
     */
    public function index(ReviewsRepository $reviewsRepository): Response
    {
        return $this->render('reviews/index.html.twig', [
            'reviews' => $reviewsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="reviews_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $review = new Reviews();
        $form = $this->createForm(ReviewsType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($review);
            $entityManager->flush();

            return $this->redirectToRoute('reviews_index');
        }

        return $this->render('reviews/new.html.twig', [
            'review' => $review,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reviews_show", methods={"GET"})
     */
    public function show(Reviews $review): Response
    {
        return $this->render('reviews/show.html.twig', [
            'review' => $review,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reviews_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reviews $review): Response
    {
        $form = $this->createForm(ReviewsType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reviews_index');
        }

        return $this->render('reviews/edit.html.twig', [
            'review' => $review,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reviews_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Reviews $review): Response
    {
        if ($this->isCsrfTokenValid('delete'.$review->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($review);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reviews_index');
    }
}
