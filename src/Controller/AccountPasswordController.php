<?php

namespace App\Controller;

use App\Entity\Header;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/compte/modification-du-mot-de-passe", name="account_password")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $headers = $this->entityManager->getRepository(Header::class)->findAll();
        $notification = null;

        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $old_pwd = $form->get('old_password')->getData();

            if ($encoder->isPasswordValid($user, $old_pwd)) {
                $new_pwd = $form->get('new_password')->getData();
                $password = $encoder->encodePassword($user, $new_pwd);

                $user->setPassword($password);
                $this->entityManager->flush();
                $notification = "Votre mot de passe a bien été mis à jour.";
            } else {
            $notification = "Votre mot de passe actuel est incorrect";
            }
        }

        return $this->render('account/password.html.twig', [
            'headers' => $headers,
            'title' => 'Modifier mon mot de passe',
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}
