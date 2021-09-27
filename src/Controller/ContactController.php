<?php

namespace App\Controller;

use App\Entity\Header;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer)
    {

        $headers = $this->entityManager->getRepository(Header::class)->findAll();

        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contactFormData = $form->getData();

            $email = (new Email())

            ->from($contactFormData['from'])
            ->to('nicolas.mercier00@orange.fr')
            ->subject('Time for Symfony Mailer!')
            ->text($contactFormData['message']);

            $mailer->send($email);
            $this->addFlash('notice', 'Votre message a été envoyé avec succès !');

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [
            'headers' => $headers,
            'title' => 'Contactez-nous',
            'contact_form' => $form->createView(),
            'image1' => "images/pagecontact/maison1.jpg",
        ]);
    }
}
