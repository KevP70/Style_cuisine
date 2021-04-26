<?php

namespace App\Controller;

use App\Entity\ImagesRandom;
use App\Entity\ImageBefore;
use App\Entity\ImageAfter;
use App\Form\ImageAfterType;
use App\Form\ImageBeforeType;
use App\Form\ImagesRandomType;
use App\Repository\ImageAfterRepository;
use App\Repository\ImageBeforeRepository;
use App\Repository\ImagesRandomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(Request $request,
                          EntityManagerInterface $entityManager,
                          ImageBeforeRepository $imageBeforeRepository,
                          ImageAfterRepository $imageAfterRepository,
                          ImagesRandomRepository $imagesRandomRepository): Response
    {
        //Add Image Random
        $imagesRandom = new ImagesRandom();
        $formRandom = $this->createForm(ImagesRandomType::class, $imagesRandom);
        $formRandom->handleRequest($request);
        if ($formRandom->isSubmitted() && $formRandom->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($imagesRandom);
            $entityManager->flush();
            return $this->redirectToRoute('admin');
        }

        // Donc la je créer la premier image
        $image = new ImageBefore();
        $form = $this->createForm(ImageBeforeType::class, $image);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isSubmitted()) {
            // Je lui set un ID
            $image->setImageId(mt_rand(1, 900));
            $entityManager->persist($image);
            $entityManager->flush();
            // Redirection sur la page pour ajouter une seconde images
            return $this->redirectToRoute('second_image', ['imageId' => $image->getImageId()]);
        }

        return $this->render('admin/index.html.twig', [
            'formRandom' => $formRandom->createView(),
            'formBefore' => $form->createView(),

            'KitchensBefore' => $imageBeforeRepository->findBy(array('categories' => 1)),
            'KitchensAfter' => $imageAfterRepository->findBy(array('categories' => 1)),
            'KitchensRandom' => $imagesRandomRepository->findBy(array('categories' => 1)),

            'BathroomsBefore' => $imageBeforeRepository->findBy(array('categories' => 2)),
            'BathroomsAfter' => $imageAfterRepository->findBy(array('categories' => 2)),
            'BathroomsRandom' => $imagesRandomRepository->findBy(array('categories' => 2)),

            'DressingsBefore' => $imageBeforeRepository->findBy(array('categories' => 3)),
            'DressingsAfter' => $imageAfterRepository->findBy(array('categories' => 3)),
            'DressingsRandom' => $imagesRandomRepository->findBy(array('categories' => 3)),
        ]);
    }


    /**
     * @Route("/admin/{imageId}", name="second_image")
     */
    public
    function secondImage(
        ImageBefore $imageBefore,
        Request $request,
        EntityManagerInterface $entityManager
    )
    {
        // AJout d'une seconde image
        $imageAfter = new ImageAfter();
        $formImageAfter = $this->createForm(ImageAfterType::class, $imageAfter);
        $formImageAfter->handleRequest($request);
        if ($formImageAfter->isSubmitted() && $formImageAfter->isSubmitted()) {
            $imageAfter->setImageBefore($imageBefore);
            $imageBefore->setImageAfter($imageAfter);
            $entityManager->persist($imageAfter);
            $entityManager->flush();
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/second_image.html.twig', [
            'formAfter' => $formImageAfter->createView(),
            'imageBefore' => $imageBefore
        ]);
    }

    /**
     * @Route("/admin/delete/{id}", name="images_random_delete")
     */
    public function delete(ImagesRandom $imagesRandom): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($imagesRandom);
        $entityManager->flush();
        return $this->redirectToRoute('admin');
    }
    /**
     * @Route("/admin/deleteBeforeAfter/{id}", name="deleteBeforeAfter")
     */
    public function deleteBeforeAfter(ImageBefore $imageBefore): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($imageBefore);
        $entityManager->flush();
        return $this->redirectToRoute('admin');
    }
}
