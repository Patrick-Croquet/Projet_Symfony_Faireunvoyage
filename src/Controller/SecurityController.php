<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Header;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, EntityManagerInterface $manager,
    UserPasswordEncoderInterface $encoder)
    {
        $headers = $this->entityManager->getRepository(Header::class)->findAll();

        $user = new User();

       $form = $this->createForm(RegistrationType::class, $user);

       $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid()) {
           $hash = $encoder->encodePassword($user, $user->getPassword());

           $user->setPassword($hash);
           $manager->persist($user);
           $manager->flush();
       }



       return $this->render('security/registration.html.twig', [
        'headers' => $headers,
        'form' => $form->createView(),
        'title' => 'Inscription sur le site',
        'image1' => "images/pageinscription/imginscription.JPG",
        ]);
    }

    /**
     * @Route("/connexion", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $headers = $this->entityManager->getRepository(Header::class)->findAll();
        
         if ($this->getUser()) {
             return $this->redirectToRoute('account');
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'headers' => $headers,
            'last_username' => $lastUsername, 
            'error' => $error,
            'title' => 'Connectez-vous']);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
