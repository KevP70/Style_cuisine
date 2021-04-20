<?php

namespace App\Controller;

use App\Entity\ImagesRandom;
use App\Form\ImagesRandomType;
use App\Repository\ImagesRandomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/images/random")
 */
class ImagesRandomController extends AbstractController
{
    /**
     * @Route("/", name="images_random_index", methods={"GET"})
     */
    public function index(ImagesRandomRepository $imagesRandomRepository): Response
    {
        return $this->render('images_random/index.html.twig', [
            'images_randoms' => $imagesRandomRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="images_random_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $imagesRandom = new ImagesRandom();
        $form = $this->createForm(ImagesRandomType::class, $imagesRandom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($imagesRandom);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/index.html.twig', [
            'images_random' => $imagesRandom,
            'formRandom' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="images_random_show", methods={"GET"})
     */
    public function show(ImagesRandom $imagesRandom): Response
    {
        return $this->render('admin/index.html.twig', [
            'images_random' => $imagesRandom,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="images_random_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ImagesRandom $imagesRandom): Response
    {
        $form = $this->createForm(ImagesRandomType::class, $imagesRandom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/index.html.twig', [
            'images_random' => $imagesRandom,
            'formRandom' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="images_random_delete", methods={"POST"})
     */
    public function delete(Request $request, ImagesRandom $imagesRandom): Response
    {
        if ($this->isCsrfTokenValid('delete'.$imagesRandom->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($imagesRandom);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin');
    }
}
