<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\User;
use App\Form\RegistrationFormType;

class SecurityController extends AbstractController{
   
   

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
