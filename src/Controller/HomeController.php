<?php

namespace App\Controller;

use App\Repository\ImageAfterRepository;
use App\Repository\ImageBeforeRepository;
use App\Repository\ImagesRandomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index( ImageBeforeRepository $imageBeforeRepository,
                           ImageAfterRepository $imageAfterRepository,
                           ImagesRandomRepository $imagesRandomRepository): Response
    {

        return $this->render('home/index.html.twig', [
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
}
