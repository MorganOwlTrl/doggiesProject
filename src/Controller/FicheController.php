<?php

namespace App\Controller;

use App\Entity\Dog;
use App\Repository\AnnonceRepository;
use App\Repository\DogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FicheController extends AbstractController
{
    /**
     * @Route("/fiche/{id}", name="fiche")
     */
    public function show(int $id, AnnonceRepository $annonceRepository, DogRepository $dogRepository): Response
    {
        $annonce = $annonceRepository
            ->find($id);
        $dogs = $dogRepository
            ->findBy(array('annonce' => $id));
        return $this->render('fiche/fiche.html.twig', [
            'controller_name' => 'FicheController',
            'annonce' => $annonce,
            'dogs' => $dogs,
        ]);
    }
}
