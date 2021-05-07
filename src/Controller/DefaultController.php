<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\AnnonceRepository;
use App\Repository\DogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(AnnonceRepository $annonceRepository, DogRepository $dogRepository): Response
    {
        $annonces = $annonceRepository->findAvailableAnnonces();
        return $this->render('default/home.html.twig', [
            'controller_name' => 'DefaultController',
            'annonces' => $annonces,
        ]);
    }

    /**
     * @Route("/conditions", name="conditions")
     */
    public function conditions(): Response
    {
        return $this->render('default/conditions.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     *  @Route("/contact/{id}", name="contactDog")
     */
    public function contact(DogRepository $dogRepository, Request $request, EntityManagerInterface $em, int $id = null): Response
    {
        $contact = new Contact();

        $dog = null;
        if($id) {
            $dog = $dogRepository

                ->find($id);
        }

        $contact->setDog($dog);
        $form = $this->createForm(ContactType::class, $contact, [
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($contact);
            $em->flush();

            return $this->redirectToRoute('default');
        }

        return $this->render('default/contact.html.twig', [
            'form' => $form->createView(),
            'dog' => $dog,

        ]);
    }
}
