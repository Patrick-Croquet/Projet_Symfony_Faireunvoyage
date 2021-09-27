<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Header;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountOrderController extends AbstractController
{

    private $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/compte/mes-commandes", name="account_order")
     */
    public function index()
    {
        $headers = $this->entityManager->getRepository(Header::class)->findAll();
        $orders = $this->entityManager->getRepository(Order::class)->findSuccessOrders($this->getUser());


        return $this->render('account/order.html.twig', [
            'title' => 'Mes commandes',
            'paragraphe' => "Dans cet espace vous allez pouvoir gérer toutes vos commandes :",
            'paragraphe1' => "Vous n'avez pas encore passé de commande sur DoDo Le Guide.",
            'headers' => $headers,
            'orders' => $orders
            
        ]);
    }


    /**
     * @Route("/compte/mes-commandes/{reference}", name="account_order_show")
     */
    public function show($reference)
    {
        $headers = $this->entityManager->getRepository(Header::class)->findAll();
        $order = $this->entityManager->getRepository(Order::class)->findOneByReference($reference);

        if (!$order || $order->getUser() != $this->getUser()) {
            return $this->redirectToRoute('account_order');
        }

        return $this->render('account/order_show.html.twig', [
            'title' => 'Ma commande : n°',
            'paragraphe' => 'Commande passé le :',
            'paragraphe1' => 'Référence de ma commande n° : ',
            'paragraphe2' => 'Transporteur choisi :',
            'paragraphe3' => 'Détails de ma commande :',
            'paragraphe4' => 'Sous-total : ',
            'paragraphe5' => 'Livraison : ',
            'paragraphe6' => 'Total : ',
            'headers' => $headers,
            'order' => $order
            
        ]);
    }
}
