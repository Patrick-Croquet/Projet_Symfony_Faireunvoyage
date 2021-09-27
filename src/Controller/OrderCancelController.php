<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Header;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderCancelController extends AbstractController
{


    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/commande/erreur/{stripeSessionId}", name="order_cancel")
     */
    public function index($stripeSessionId)
    {

        $headers = $this->entityManager->getRepository(Header::class)->findAll();
        $order = $this->entityManager->getRepository(Order::class)->findOneByStripeSessionId($stripeSessionId);


        if (!$order || $order->getUser() != $this->getUser()) {
            return $this->redirectToRoute('home');
        }
        
        return $this->render('order_cancel/index.html.twig', [
            'title' => 'Erreur de paiement',
            'paragraphe' => 'Bonjour',
            'paragraphe1' => 'Il semblerait que votre paiement est échoué pour votre commande n° ',
            'paragraphe2' => "Une confirmation d'erreur vient de vous être envoyée par email à l'adresse : ",
            'headers' => $headers,
            'order' => $order
        ]);
    }
}
