<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\ImageAfterRepository;
use App\Repository\ImageBeforeRepository;
use App\Repository\ImagesRandomRepository;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @Route("/#contact", name="home_contact")
     */
    public function index( Request $request,
                           Swift_Mailer $mailer,
                           ImageBeforeRepository $imageBeforeRepository,
                           ImageAfterRepository $imageAfterRepository,
                           ImagesRandomRepository $imagesRandomRepository): Response
    {

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $message = (new \Swift_Message('Nouveau message'))
                ->setFrom($contact['email'])
                ->setTo('kevin.petronelli@gmail.com')
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig', compact('contact')
                    ),
                    'text/html'
                )
            ;
            $mailer->send($message);
            $this->addFlash('success', 'Votre message a bien été envoyé.');
            return $this->redirectToRoute('home');
        }

        return $this->render('home/index.html.twig', [
            'contactForm' => $form->createView(),

            'KitchensBefore' => $imageBeforeRepository->findBy(array('categories' => 1)),
            'KitchensAfter' => $imageAfterRepository->findBy(array('categories' => 1)),
            'KitchensRandom' => $imagesRandomRepository->findBy(array('categories' => 1)),

            'BathroomsBefore' => $imageBeforeRepository->findBy(array('categories' => 2)),
            'BathroomsAfter' => $imageAfterRepository->findBy(array('categories' => 2)),
            'BathroomsRandom' => $imagesRandomRepository->findBy(array('categories' => 2)),

            'DressingsBefore' => $imageBeforeRepository->findBy(array('categories' => 3)),
            'DressingsAfter' => $imageAfterRepository->findBy(array('categories' => 3)),
            'DressingsRandom' => $imagesRandomRepository->findBy(array('categories' => 3)),

            'SpecialsBefore' => $imageBeforeRepository->findBy(array('categories' => 4)),
            'SpecialsAfter' => $imageAfterRepository->findBy(array('categories' => 4)),
            'SpecialsRandom' => $imagesRandomRepository->findBy(array('categories' => 4)),
        ]);
    }
}
