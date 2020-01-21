<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface as ObjectManager;

use App\Entity\User;
use App\Entity\Echange;
use App\Form\EchangeType;
use App\Repository\EchangeRepository;

class EchangeController extends AbstractController{
   
    /**
    * @Route("/ajout_echange", name="ajout_echange")
    */
    public function ajoutEchange(Request $request, ObjectManager $manager){
        $echange = new Echange();

        $form = $this->createForm(EchangeType::class, $echange);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($echange);
            $manager->flush();
        }

        return $this->render('vip/echange2.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
    * @var EchangeRepository;
    */
    private $repository;
    public function __construct(EchangeRepository $echange_repository)
    {
        $this->echange_repository = $echange_repository;
    }

    /**
     * @Route("/echange_liste", name = "liste_echanges")
     */
    public function liste_echange()
    {
        $echanges = $this->echange_repository->findAll();
        return $this->render('vip/echange.html.twig', compact('echanges'));
    }
}
