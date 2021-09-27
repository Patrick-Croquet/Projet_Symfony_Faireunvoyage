<?php

namespace App\Controller;

use App\Entity\Header;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BdController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * @Route("/home", name="app_home")
     */
    public function home()
    {
        
        $products = $this->entityManager->getRepository(Product::class)->findByIsBest(1);
        $headers = $this->entityManager->getRepository(Header::class)->findAll();

        return $this->render('pages/home.html.twig', [
            'products' => $products,
            'headers' => $headers,
            'title' => " '' Le DoDo Y Guide A Ou ! '' ",
            'titletraduction' => " '' Le DoDo Vous Guide ! ''",
            'intro1' => "Avec  ",
            'intro2' => " Vous Serez Votre Propre Guide.",
            'intro3' => "Voici Nos ",
            'intro4' => "Conseils ",
            'intro5' => " Et Notre ",
            'intro6' => " Séléctions ",
            'intro7' => " De Lieux Et D'activités Incontournables à Decouvrir Lors De Votre Séjour.",
            'video' => "https://www.youtube.com/embed/UoTYNd3luOA?autoplay=1&mute=1&enablejsapi=1controls=0loop=1&amp;start=56",
            'icones' => "images/pagehome/icones/vanille.svg",
            'featurette1' => "images/pagehome/featurette/rando.png",
            'featurette2' => "images/pagehome/featurette/sport.png",
            'featurette3' => "images/pagehome/featurette/plage.png",
            'featurette4' => "images/pagehome/featurette/eglise.png",
            'featurette5' => "images/pagehome/featurette/zourit.png",
            'featurette6' => "images/pagehome/featurette/plantes.JPG",
            'icones1' => "images/pagehome/icones/panneau1.png",
        ]);

    }

    /**
     * @Route("/randonnée", name="app_randonnée")
     */
    public function randonnée()
    {

        $headers = $this->entityManager->getRepository(Header::class)->findAll();

        return $this->render('pages/randonnée.html.twig', [
            'headers' => $headers,
            'title' => 'Les Randonnées',
            'titlef1' => 'Piton de la fournaise',
            'featurettes1' => "images/pagerandonnées/featurettes/pitondelafournaise/piton.jpg",
            'titlef2' => "Plage de l'hermitage",
            'featurettes2' => "images/pagerandonnées/featurettes/plagedelhermitage/hermitage.png",
            'titlef3' => 'Cirque de cilaos',
            'featurettes3' => "images/pagerandonnées/featurettes/cirquecilaos/cilaospano.jpg",
            'titlef4' => 'Puits des anglais',
            'featurettes4' => "images/pagerandonnées/featurettes/puitdesanglais/puit.jpg",
            'titlef5' => 'Trou de fer',
            'featurettes5' => "images/pagerandonnées/featurettes/troudefer/trou-de-fer.jpg",
            'titlef6' => 'Cirque de mafate',
            'featurettes6' => "images/pagerandonnées/featurettes/mafate/mafate.jpg",
            'titlef7' => 'Bois court grand bassin',
            'featurettes7' => "images/pagerandonnées/featurettes/boiscourt/grandbassinboiscourt.jpg",
            'titlef8' => "Marre à poule d'eau",
            'featurettes8' => "images/pagerandonnées/featurettes/marreapouledeau/marre.jpg",
            'titlef9' => 'Cirque de salazie',
            'featurettes9' => "images/pagerandonnées/featurettes/salazie/salazie1.jpg",
        ]);
    }

    /**
     * @Route("/activitésportive", name="app_activitésportive")
     */
    public function activitésportive()
    {
        $headers = $this->entityManager->getRepository(Header::class)->findAll();
        return $this->render('pages/activitésportive.html.twig', [
            'headers' => $headers,
            'title' => 'Activité Sportive',
        ]);
    }

    /**
     * @Route("/plage", name="app_plage")
     */
    public function plage()
    {
        $headers = $this->entityManager->getRepository(Header::class)->findAll();
        return $this->render('pages/plage.html.twig', [
            'headers' => $headers,
            'title' => 'Plage',
        ]);
    }

    /**
     * @Route("/visite", name="app_visite")
     */
    public function visite()
    {
        $headers = $this->entityManager->getRepository(Header::class)->findAll();
        return $this->render('pages/visite.html.twig', [
            'headers' => $headers,
            'title' => 'Visite',
        ]);
    }

    /**
     * @Route("/plats", name="app_plats")
     */
    public function plats()
    {
        $headers = $this->entityManager->getRepository(Header::class)->findAll();
        return $this->render('pages/visite.html.twig', [
            'headers' => $headers,
            'title' => 'Plats',
        ]);
    }

    /**
     * @Route("/biodiversité", name="app_biodiversité")
     */
    public function biodiversité()
    {
        $headers = $this->entityManager->getRepository(Header::class)->findAll();
        return $this->render('pages/biodiversité.html.twig', [
            'headers' => $headers,
            'title' => 'Biodiversité',
        ]);
    }

    /**
     * @Route("/histoire", name="app_histoire")
     */
    public function histoire()
    {
        $headers = $this->entityManager->getRepository(Header::class)->findAll();
        return $this->render('pages/histoire.html.twig', [
            'headers' => $headers,
            'title' => 'Histoire',
        ]);
    }

    /**
     * @Route("/about", name="app_about")
     */
    public function about()
    {
        $headers = $this->entityManager->getRepository(Header::class)->findAll();
        return $this->render('pages/about.html.twig', [
            'headers' => $headers,
            'title' => 'about',
        ]);
    }
}