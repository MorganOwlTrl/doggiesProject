<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Dog;
use App\Form\AddAnnonceFormType;
use App\Form\AddDogType;
use App\Repository\AnnonceRepository;
use App\Repository\BreedRepository;
use App\Repository\DogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserDashboardController extends AbstractController
{
    /**
     * @Route("/user/dashboard", name="user_dashboard")
     */
    public function index(DogRepository $dogRepository): Response
    {
        $dogs = $dogRepository->findAll();
        return $this->render('user/dashboard.html.twig', [
            'controller_name' => 'UserDashboardController',
            'dogs' => $dogs
        ]);
    }

    /**
     * @Route("/user/addAnnonce", name="user_addAnnonce")
     */
    public function addAnnonce(Request $request, EntityManagerInterface $em): Response
    {

        $annonce = new Annonce();

       $form = $this->createForm(AddAnnonceFormType::class, $annonce, [
           'method' => 'POST',
       ]);

       $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($annonce);
            $em->flush();

            return $this->redirectToRoute('user_dashboard');
        }
        return $this->render('user/addAnnonce.html.twig', [
            'form' => $form->createView(), // On crée un objet FormView, qui sert à l'affichage de notre formulaire
        ]);

    }


    /**
     * @Route("/user/addDog", name="user_addDog")
     * @Route("/user/updateDog/{id}", name="user_updateDog")
     */
    public function addDog(Request $request, EntityManagerInterface $em, Dog $dog = null): Response
    {

        /*dd($dog);*/
/*        if ($dog == null) {
            $dog = new Dog();
        }*/

        $form = $this->createForm(AddDogType::class, $dog, [
            'method' => 'POST',
        ]);

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($dog);
            $em->flush();

            return $this->redirectToRoute('user_dashboard');
        }
        return $this->render('user/addDog.html.twig', [
            'form' => $form->createView(), // On crée un objet FormView, qui sert à l'affichage de notre formulaire
        ]);

    }


    /**
     * @Route("/user/deleteDog/{id}", name="user_deleteDog")
     */
    public function deleteDog(int $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $dog = $em->getRepository(Dog::class)->find($id);

        if (!$dog) {
            throw $this->createNotFoundException(
                'Pas de chien trouvé pour cet id : '.$id
            );
        }

        $em->remove($dog);
        $em->flush();

        return $this->redirectToRoute('user_dashboard');
    }
}
