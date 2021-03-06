<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface as ObjectManager;

use App\Entity\User;
use App\Form\RegistrationFormType;

class SecurityController extends AbstractController{
   
    /**
    * @Route("/inscription", name="security_registration")
    */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder){
        $user = new User();

        $form = $this->createForm(RegistrationFormType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();
        }

        return $this->render('security/index.html.twig',[
            'form' => $form->createView()
        ]);
    }
   

    /**
    * @Route("/connexion", name="security_login")
    */
   public function login(){
       return $this->render('security/index.html.twig');
   }
   
   /**
    * @Route("/deconnexion", name="security_logout")
    */
    public function logout(){}
}
