<?php

namespace App\Controller;

use App\Entity\ImagesRandom;
use App\Entity\ImageBefore;
use App\Entity\ImageAfter;
use App\Entity\ImageTest;
use App\Form\ImageAfterType;
use App\Form\ImageBeforeType;
use App\Form\ImagesRandomType;
use App\Form\ImageTestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(Request $request): Response
    {
        $imagesRandom = new ImagesRandom();
        $imageBefore = new ImageBefore();
        $imageAfter = new ImageAfter();
        $imagTest = new ImageTest();

        $formRandom = $this->createForm(ImagesRandomType::class, $imagesRandom);
        $formBefore = $this->createForm(ImageBeforeType::class);
        $formAfter = $this->createForm(ImageAfterType::class, $imageAfter);


        $formTest = $this->createForm(ImageTestType::class, $imagTest);

        $formRandom->handleRequest($request);
        $formBefore->handleRequest($request);
        $formAfter->handleRequest($request);


        $formTest->handleRequest($request);






        if ($formTest->isSubmitted() && $formTest->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($imagTest);
            $entityManager->flush();
            return $this->redirectToRoute('admin');
        }



        if ($formBefore->isSubmitted() && $formBefore->isValid()) {
            $imageBefore = $formBefore->get('images')->getData();
            $imageAfter = $formBefore->get('imagesAfter');




            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($imageBefore);
            $entityManager->persist($imageAfter);
            $entityManager->flush();
            return $this->redirectToRoute('admin');
        }

        if ($formAfter->isSubmitted() && $formAfter->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($imageAfter);
            $entityManager->flush();
            return $this->redirectToRoute('admin');
        }

        $randomKitchen = $this->getDoctrine()->getRepository(ImagesRandom::class)->findBy(array('categories' => 1));
        $randomBathroom = $this->getDoctrine()->getRepository(ImagesRandom::class)->findBy(array('categories' => 2));
        $randomDressing = $this->getDoctrine()->getRepository(ImagesRandom::class)->findBy(array('categories' => 3));

        $KitchenBefore = $this->getDoctrine()->getRepository(ImageBefore::class)->findBy(array('categories' => 1));
        $BathroomBefore = $this->getDoctrine()->getRepository(ImageBefore::class)->findBy(array('categories' => 2));
        $DressingBefore = $this->getDoctrine()->getRepository(ImageBefore::class)->findBy(array('categories' => 3));

        $KitchenAfter = $this->getDoctrine()->getRepository(ImageAfter::class)->findBy(array('categories' => 1));
        $BathroomAfter = $this->getDoctrine()->getRepository(ImageAfter::class)->findBy(array('categories' => 2));
        $DressingAfter = $this->getDoctrine()->getRepository(ImageAfter::class)->findBy(array('categories' => 3));

        return $this->render('admin/index.html.twig', [
            'randomKitchen' => $randomKitchen,
            'randomBathroom' => $randomBathroom,
            'randomDressing' => $randomDressing,

            'kitchenBefore' => $KitchenBefore,
            'BathroomBefore' => $BathroomBefore,
            'DressingBefore' => $DressingBefore,

            'kitchenAfter' => $KitchenAfter,
            'BathroomAfter' => $BathroomAfter,
            'DressingAfter' => $DressingAfter,

            'formRandom' => $formRandom->createView(),
            'formBefore' => $formBefore->createView(),
            'formAfter' => $formAfter->createView(),
            'formTest' => $formTest->createView(),
        ]);
    }
}
