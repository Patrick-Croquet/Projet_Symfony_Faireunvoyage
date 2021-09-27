<?php

namespace App\Controller;

use App\Entity\Header;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * @Route("/compte", name="account")
     */
    public function index()
    {
        $headers = $this->entityManager->getRepository(Header::class)->findAll();
        return $this->render('account/index.html.twig', [
            'headers' => $headers,
            'title' => 'Mon Compte',
        ]);
    }
}
