<?php

namespace App\Controller;

use App\Entity\ImageAfter;
use App\Entity\ImageBefore;
use App\Entity\ImagesRandom;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $randomKitchen = $this->getDoctrine()->getRepository(ImagesRandom::class)->findBy(array('categories' => 1));
        $randomBathroom = $this->getDoctrine()->getRepository(ImagesRandom::class)->findBy(array('categories' => 2));
        $randomDressing = $this->getDoctrine()->getRepository(ImagesRandom::class)->findBy(array('categories' => 3));

        $KitchenBefore = $this->getDoctrine()->getRepository(ImageBefore::class)->findBy(array('categories' => 1));
        $BathroomBefore = $this->getDoctrine()->getRepository(ImageBefore::class)->findBy(array('categories' => 2));
        $DressingBefore = $this->getDoctrine()->getRepository(ImageBefore::class)->findBy(array('categories' => 3));

        $KitchenAfter = $this->getDoctrine()->getRepository(ImageAfter::class)->findBy(array('categories' => 1));
        $BathroomAfter = $this->getDoctrine()->getRepository(ImageAfter::class)->findBy(array('categories' => 2));
        $DressingAfter = $this->getDoctrine()->getRepository(ImageAfter::class)->findBy(array('categories' => 3));
        return $this->render('home/index.html.twig', [
            'randomKitchen' => $randomKitchen,
            'randomBathroom' => $randomBathroom,
            'randomDressing' => $randomDressing,

            'kitchenBefore' => $KitchenBefore,
            'BathroomBefore' => $BathroomBefore,
            'DressingBefore' => $DressingBefore,

            'kitchenAfter' => $KitchenAfter,
            'BathroomAfter' => $BathroomAfter,
            'DressingAfter' => $DressingAfter,
        ]);
    }
}
