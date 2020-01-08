<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\JoueurRepository;
use App\Entity\Joueur;
use Doctrine\Common\Persistence\ObjectManager;

class VipController extends AbstractController
{
    /**
    * @var JoueurRepository;
    */
    private $repository;
    public function __construct(JoueurRepository $joueur_repository)
    {
        $this->joueur_repository = $joueur_repository;
    }

    /**
     * @Route("/joueur_liste", name = "liste_joueurs")
     */
    public function liste()
    {
        $joueurs = $this->joueur_repository->findAll();
        return $this->render('vip/index.html.twig', compact('joueurs'));
    }

    /**
     * @Route("/joueur/{id}", name = "details_joueur")
     */
    public function show($id)
    {
        $repo = $this->getDoctrine()->getRepository(Joueur::class);

        $joueur = $repo->find($id);

        return $this->render('vip/show.html.twig', [
            'joueur'=> $joueur 
        ]);
    }
}
