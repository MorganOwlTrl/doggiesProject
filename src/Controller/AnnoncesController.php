<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Repository\AnnonceRepository;
use App\Repository\DogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AnnoncesController extends AbstractController
{
    /**
     * @Route("/annonces", name="annonces")
     */
    public function index(AnnonceRepository $annonceRepository): Response
    {
        $annonces = $annonceRepository->findAvailableAnnonces(4);

        return $this->render('annonces/annonces.html.twig', [
            'controller_name' => 'AnnoncesController',
            'annonces' => $annonces,
        ]);
    }
}
