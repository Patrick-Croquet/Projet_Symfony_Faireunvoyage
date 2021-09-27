<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Order;
use App\Entity\Header;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderSuccessController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/commande/merci/{stripeSessionId}", name="order_validate")
     */
    public function index(Cart $cart, $stripeSessionId)
    {
        $headers = $this->entityManager->getRepository(Header::class)->findAll();
        
        $order = $this->entityManager->getRepository(Order::class)->findOneByStripeSessionId($stripeSessionId);


        if (!$order || $order->getUser() != $this->getUser()) {
            return $this->redirectToRoute('home');
        }

        if ($order->getState() == 0) {

            $cart->remove();

            $order->setState(1);
            $this->entityManager->flush();
        }

        

        return $this->render('order_success/index.html.twig', [
            'title' => 'Confirmation de commande',
            'paragraphe' => 'Bonjour',
            'paragraphe1' => 'Nous vous remercions pour votre commande : n° ',
            'paragraphe2' => "Une confirmation vient de vous être envoyée par email à l'adresse : ",
            'paragraphe3' => "Votre commande sera livrée par ",
            'paragraphe4' => " à l'adresse suivante : ",
            'paragraphe5' => "Pour suivre votre commande, rendez-vous dans votre ",
            'headers' => $headers,
            'order' => $order
        ]);
    }
}
